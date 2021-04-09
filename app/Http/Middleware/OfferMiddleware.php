<?php

namespace App\Http\Middleware;

use App\Offer;
use Closure;

class OfferMiddleware
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
        if (Offer::whereNotNull('offer_date')->get()->count() == 0) {
            return back();
        }
        return $next($request);
    }
}
