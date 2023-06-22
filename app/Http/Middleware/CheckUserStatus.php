<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->status !== 'ACTIVE') {
            $email = Auth::user()->email;
            session()->flash('oldEmail', $email);
            Auth::logout();
            return redirect()->back()->withErrors(['inactive' => 'Tài khoản của bạn đã bị khóa.'])->withInput();
        }
        return $next($request);
    }
}
