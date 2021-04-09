<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\User;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
        $attr = $request->all();
        $attr['password'] = bcrypt($request->password);
        User::create($attr);

        session()->flash('success', 'User telah berhasil di daftarkan!');
        return redirect('/');
    }
}
