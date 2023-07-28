<?php

namespace Modules\Site\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Site\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function loginForm()
    {
        return view('site.auth.login');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function login(LoginRequest $request)
    {
        $inputs = $request->all();
        $user = User::where('username', $request->username)->first();
        if (Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('customer.profile.profile')->with('swal-success', 'خوش آمدید');
        } else {
            return redirect()->route('auth.login-form')
                ->withErrors(['password' => 'اطلاعات وارد شده معتبر نمیباشد !']);
        }
    }
}
