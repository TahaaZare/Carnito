<?php

namespace Modules\Site\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Site\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function registerForm()
    {
        return view('site.auth.register');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function register(RegisterRequest $request)
    {
        $inputs = $request->all();
        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 0;
        $user = User::create([
            'username' => $inputs['username'],
            'password' => $inputs['password']
        ]);
        return redirect()->route('auth.login-form')->with('swal-success', 'ثبت نام شما با موفقیت انجام شد ! لطفا وارد حساب کاربری خود شوید.');
    }
}
