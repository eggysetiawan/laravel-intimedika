<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profiles.index', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $cities = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')['provinsi'];
        return view('profiles.edit', compact('user', 'cities'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, User $user)
    {
        $user->update($request->all());
        session()->flash('success', 'Profil berhasil diperbarui!');
        return back();
    }

    public function changePassword(ChangePasswordRequest $request, User $user)
    {
        if (!Hash::check($request->password_old, auth()->user()->password)) {
            return back()->with('error', 'Password Salah');
        }
        $user->update([
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success', 'Password telah berhasil diperbarui!');
        return back();
    }

    public function updatePicture(User $user)
    {
        // jika belum ada foto
        if (!$user->getFirstMediaUrl('profile')) {
            $imgSlug = uniqid() . '.' . request()->file('img')->extension();
            $user->addMediaFromRequest('img')
                ->usingFileName($imgSlug)
                ->toMediaCollection('profile');

            session()->flash('success', 'Foto berhasil diperbarui!');

            return back();
        }

        // update foto
        $user->media()->delete();
        $imgSlug = uniqid() . '.' . request()->file('img')->extension();
        $user->addMediaFromRequest('img')
            ->usingFileName($imgSlug)
            ->toMediaCollection('profile');

        session()->flash('success', 'Foto berhasil diperbarui!');

        return back();

        session()->flash('success', 'Foto berhasil diperbarui!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
