<?php

namespace App\Http\Controllers;


class LoginEmailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        if (auth()->guest()) :
            return view('auth.email-login');
        else :
            return redirect('/');
        endif;
    }
}
