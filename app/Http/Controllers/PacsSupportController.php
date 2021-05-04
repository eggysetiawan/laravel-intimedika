<?php

namespace App\Http\Controllers;

use App\DataTables\PacsSupportDataTable;
use App\PacsSupport;
use Illuminate\Http\Request;

class PacsSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PacsSupportDataTable $dataTable)
    {
        return $dataTable->render('pacs.supports.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pacs.supports.create');
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
     * @param  \App\PacsSupport  $pacsSupport
     * @return \Illuminate\Http\Response
     */
    public function show(PacsSupport $pacsSupport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PacsSupport  $pacsSupport
     * @return \Illuminate\Http\Response
     */
    public function edit(PacsSupport $pacsSupport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PacsSupport  $pacsSupport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PacsSupport $pacsSupport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PacsSupport  $pacsSupport
     * @return \Illuminate\Http\Response
     */
    public function destroy(PacsSupport $pacsSupport)
    {
        //
    }
}
