<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResendEmailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (auth()->guest()) :
            return view('auth.resend-email');
        else :
            return redirect('/');
        endif;
    }
}
