<?php

namespace App\Http\Middleware;

use Closure;

class RegisterUserMiddleware
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
        if (!auth()->user()->superAdmin()) {
            return abort(403);
        }
        return $next($request);
    }
}
