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

    // Permission::create(['name' => 'approval']);
    // Permission::create(['name' => 'salesman']);
    // Permission::create(['name' => 'admin']);
    // Permission::create(['name' => 'supervise']);
    public function __invoke(RegisterRequest $request)
    {
        $attr = $request->all();
        $attr['password'] = bcrypt($request->password);
        $user = User::create($attr);

        $user->assignRole($request->role);

        session()->flash('success', 'User telah berhasil di daftarkan!');
        return redirect('/');
    }
}
