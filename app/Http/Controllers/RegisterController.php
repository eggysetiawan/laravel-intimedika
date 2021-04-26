<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\User;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\RegisterRequest  $request
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

        if ($request->role == 'supervisor') {
            $user->assignRole('sales');
            $user->givePermissionTo('supervise');
        }

        if ($request->role != 'supervisor') {
            $user->assignRole($request->role);
        }

        session()->flash('success', 'User telah berhasil di daftarkan!');
        return redirect()->route('home');
    }
}
