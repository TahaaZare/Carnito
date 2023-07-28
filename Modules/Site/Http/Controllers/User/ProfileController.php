<?php

namespace Modules\Site\Http\Controllers\User;

use App\Http\Services\Image\ImageService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Site\Http\Requests\User\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (Auth::user()) {
            return view('site::profile.customer-profile');
        } else {
            return redirect()->route('auth.login-form');
        }
    }

    public function update(UpdateProfileRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        $user = auth()->user();
        if ($request->hasFile('profile_photo_path')) {
            if (!empty($user->profile_photo_path)) {
                $imageService->deleteImage($user->profile_photo_path);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));
            if ($result === false) {
                return redirect()->route('customer.profile.profile')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $inputs['first_name'] = $request->first_name;
        $inputs['last_name'] = $request->last_name;
        $inputs['code_meli'] = $request->code_meli;
        $inputs['job'] =  $request->job;
        $inputs['adderss'] = $request->adderss;



        $user = auth()->user();
        $user->update($inputs);
        return redirect()->route('customer.profile.profile')->with('swal-success', 'حساب کاربری با موفقیت ویرایش شد');
    }
}
