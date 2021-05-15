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
            $user->assignRole('supervisor');
            // $user->givePermissionTo('supervise');
        }

        switch ($request->position) {
            case 'IT Developer':
                $user->assignRole('it');
                break;
            case 'Teknisi':
                $user->assignRole('teknisi');
                break;
            case 'Admin':
                $user->assignRole('admin');
                break;
            case 'Sales':
                $user->assignRole('sales');
                break;
        }

        session()->flash('success', 'User telah berhasil di daftarkan!');
        return redirect()->route('home');
    }
}
