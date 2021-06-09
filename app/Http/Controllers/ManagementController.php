<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRoleRequest;
use App\Http\Requests\RemoveRoleRequest;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('last_login_time', 'desc')->get();
        $roles = Role::where('name', '!=', 'superadmin')->get();
        return view('managements.users.index', compact('users', 'roles'));
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(AddRoleRequest $request, User $user)
    {
        $request->validated();
        $user->assignRole($request->roles);
        session()->flash('success', 'Role berhasil ditambahkan');
        return back();
    }

    public function removeRole(RemoveRoleRequest $request, User $user)
    {
        $request->validated();
        $user->removeRole($request->roles);
        session()->flash('success', 'Role berhasil dihapus');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
    }
}
