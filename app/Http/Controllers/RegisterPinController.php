<?php

namespace App\Http\Controllers;

use App\Http\Requests\PinRequest;
use App\User;
use Illuminate\Support\Facades\Hash;

class RegisterPinController extends Controller
{
    public function create()
    {
        return view('pins.create');
    }

    public function update(PinRequest $request)
    {
        $user =  User::where('id', auth()->id())->first();
        $user->update([
            'pin' => Hash::make($request->pin),
        ]);


        session()->flash('success', 'Pin berhasil dibuat!');
        return redirect('/');
    }
}
