<?php

namespace Modules\Site\Http\Controllers\Auth;

use App\Http\Services\Message\MessageSerivce;
use App\Http\Services\Message\Sms\SmsService;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Modules\Permission\Database\Seeders\PermissionDatabaseSeeder;
use Modules\Permission\Entities\Permission;
use Modules\Role\Database\Seeders\RoleDatabaseSeeder;
use Modules\Role\Entities\Role;
use Modules\Site\Database\Seeders\UserDatabaseSeederTableSeeder;
use Modules\Site\Entities\Auth\Otp;
use Modules\Site\Http\Requests\LoginRegisterConfrimRequest;
use Modules\Site\Http\Requests\LoginRegisterRequest;

class LoginRegisterController extends Controller
{
    public function loginRegisterForm()
    {
        #region role

        $role = Role::first();
        if ($role === null) {
            $default  = new RoleDatabaseSeeder();
            $default->run();
        }


        #endregion
        #region permissions

        $permission = Permission::first();
        if ($permission === null) {
            $default  = new PermissionDatabaseSeeder();
            $default->run();
        }

        #endregion

        #region user

        $user = User::first();
        if ($user === null) {
            $default  = new UserDatabaseSeederTableSeeder();
            $default->run();
        }


        #endregion
        return view('site.auth.login-register');
    }


    public function loginRegister(LoginRegisterRequest $request)
    {
        $inputs = $request->all();

        //check id is email or not
        if (filter_var($inputs['id'], FILTER_VALIDATE_EMAIL)) {
            $type = 1; // 1 => email
        }

        //check id is mobile or not
        elseif (preg_match('/^(\+98|98|0)9\d{9}$/', $inputs['id'])) {
            $type = 0; // 0 => mobile;


            // all mobile numbers are in on format 9** *** ***
            $inputs['id'] = ltrim($inputs['id'], '0');
            $inputs['id'] = substr($inputs['id'], 0, 2) === '98' ? substr($inputs['id'], 2) : $inputs['id'];
            $inputs['id'] = str_replace('+98', '', $inputs['id']);

            $user = User::where('mobile', $inputs['id'])->first();
            if (empty($user)) {
                $newUser['mobile'] = $inputs['id'];
            }
        } else {
            $errorText = 'شناسه ورودی شما نه شماره موبایل است نه ایمیل';
            return redirect()->route('auth.login-register-form')->withErrors(['id' => $errorText]);
        }

        if (empty($user)) {
            $newUser['password'] = '98355154';
            $newUser['activation'] = 1;
            $user = User::create($newUser);
        }

        //create otp code
        $otpCode = rand(111111, 999999);
        $token = Str::random(60);
        $otpInputs = [
            'token' => $token,
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'login_id' => $inputs['id'],
            'type' => $type,
        ];

        Otp::create($otpInputs);

        //send sms or email

        if ($type == 0) {
            //send sms
            $smsService = new SmsService();
            $smsService->setFrom(Config::get('sms.otp_from'));
            $smsService->setTo(['0' . $user->mobile]);
            $smsService->setText(" اسم سایت \n  کد تایید : $otpCode");
            $smsService->setIsFlash(true);

            $messagesService = new MessageSerivce($smsService);
        } elseif ($type === 1) {
            return redirect()->back()->with('swal-warning', 'لطفا شماره تماس خود را وارد کنید');
            // $emailService = new EmailService();
            // $details = [
            //     'title' => 'ایمیل فعال سازی',
            //     'body' => "کد فعال سازی شما : $otpCode"
            // ];
            // $emailService->setDetails($details);
            // $emailService->setFrom('noreply@example.com', 'example');
            // $emailService->setSubject('کد احراز هویت');
            // $emailService->setTo($inputs['id']);

            // $messagesService = new MessageSerivce($emailService);
        }

        $messagesService->send();

        return redirect()->route('auth.login-confirm-form', $token);
    }


    public function loginConfirmForm($token)
    {

        $otp = Otp::where('token', $token)->first();
        if (empty($otp)) {
            return redirect()->route('auth.login-register-form')->withErrors(['id' => 'آدرس وارد شده نامعتبر میباشد']);
        }
        return view('site.auth.login-confirm', compact('token', 'otp'));
    }


    public function loginConfirm($token, LoginRegisterConfrimRequest $request)
    {
        $inputs = $request->all();


        $otp = Otp::where('token', $token)->where('used', 0)->where('created_at', '>=', Carbon::now()->subMinute(5)->toDateTimeString())->first();
        if (empty($otp)) {
            return redirect()->route('auth.login-register-form', $token)->withErrors(['id' => 'آدرس وارد شده نامعتبر میباشد']);
        }

        //if otp not match
        if ($otp->otp_code !== $inputs['otp']) {
            return redirect()->route('auth.login-confirm-form', $token)->withErrors(['otp' => 'کد وارد شده صحیح نمیباشد']);
        }


        // if everything is ok :
        $otp->update(['used' => 1]);
        $user = $otp->user()->first();
        if ($otp->type == 0 && empty($user->mobile_verified_at)) {
            $user->update(['mobile_verified_at' => Carbon::now()]);
        } elseif ($otp->type == 1 && empty($user->email_verified_at)) {
            $user->update(['email_verified_at' => Carbon::now()]);
        }
        Auth::login($user);
        return redirect()->route('customer.profile.profile');
    }

    public function loginResendOtp($token)
    {
        $otp = Otp::where('token', $token)->where('created_at', '<=', Carbon::now()->subMinutes(5)->toDateTimeString())->first();

        if (empty($otp)) {
            return redirect()->route('auth.login-register-form', $token)->withErrors(['id' => 'ادرس وارد شده نامعتبر است']);
        }


        $user = $otp->user()->first();
        //create otp code
        $otpCode = rand(111111, 999999);
        $token = Str::random(60);
        $otpInputs = [
            'token' => $token,
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'login_id' => $otp->login_id,
            'type' => $otp->type,
        ];

        Otp::create($otpInputs);

        //send sms or email

        if ($otp->type == 0) {
            //send sms
            $smsService = new SmsService();
            $smsService->setFrom(Config::get('sms.otp_from'));
            $smsService->setTo(['0' . $user->mobile]);
            $smsService->setText("مجموعه . . . \n  کد تایید : $otpCode");
            $smsService->setIsFlash(true);

            $messagesService = new MessageSerivce($smsService);
        } elseif ($otp->type === 1) {
            return redirect()->back()->with('swal-warning', 'لطفا شماره تماس خود را وارد کنید');
            // $emailService = new EmailService();
            // $details = [
            //     'title' => 'ایمیل فعال سازی',
            //     'body' => "کد فعال سازی شما : $otpCode"
            // ];
            // $emailService->setDetails($details);
            // $emailService->setFrom('noreply@example.com', 'example');
            // $emailService->setSubject('کد احراز هویت');
            // $emailService->setTo($otp->login_id);

            // $messagesService = new MessageSerivce($emailService);
        }

        $messagesService->send();

        return redirect()->route('auth.login-confirm-form', $token);
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login-form');
    }
}
