<?php

namespace App\Http\Middleware;

use Closure;

class TwoFactorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->two_factor_code != auth()->user()->two_factor_code) {
            session()->flash('error', 'Kode OTP yang anda masukkan salah!');
            return back();
        }
        return $next($request);
    }
}
