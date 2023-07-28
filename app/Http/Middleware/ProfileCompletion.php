<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProfileCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() != null) {
            if (!empty(Auth::user()->email) && empty(Auth::user()->mobile) && empty(Auth::user()->email_verify_at)) {
                return redirect()->route('customer.sales-process.profile-completion');
            }
            if (
                empty(Auth::user()->first_name || empty(Auth::user()->last_name) || empty(Auth::user()->code_meli)) || empty(Auth::user()->job)
                || empty(Auth::user()->adderss)
            ) {
                return redirect()->route('customer.sales-process.profile-completion');
            }
            
            if (!empty(Auth::user()->mobile) && empty(Auth::user()->email) && empty(Auth::user()->mobile_verify_at)) {
                return redirect()->route('customer.sales-process.profile-completion');
            }
        } else {

            return redirect()->route('auth.login-register-form');
        }

        return $next($request);
    }
}
