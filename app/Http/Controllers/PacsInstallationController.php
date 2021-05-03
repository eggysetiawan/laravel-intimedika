<?php

namespace App\Http\Controllers;

use App\PacsInstallation;
use Illuminate\Http\Request;

class PacsInstallationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pacs.installation.create');
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
     * @param  \App\PacsInstallation  $pacsInstallation
     * @return \Illuminate\Http\Response
     */
    public function show(PacsInstallation $pacsInstallation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PacsInstallation  $pacsInstallation
     * @return \Illuminate\Http\Response
     */
    public function edit(PacsInstallation $pacsInstallation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PacsInstallation  $pacsInstallation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PacsInstallation $pacsInstallation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PacsInstallation  $pacsInstallation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PacsInstallation $pacsInstallation)
    {
        //
    }
}
