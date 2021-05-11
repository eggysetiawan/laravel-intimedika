<?php

namespace App\Http\Controllers;

use App\User;
use App\PacsSupport;
use App\PacsEngineer;
use App\PacsInstallation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\PacsSupportDataTable;
use App\Http\Requests\PacsSupportRequest;
use App\Http\Requests\UpdatePacsSupportRequest;
use App\Services\PacsSupportService;
use Illuminate\Support\Facades\DB;

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
        return view('pacs.supports.create', [
            'pacss' => PacsInstallation::whereHas('hospital')->get(),
            'support' => new PacsSupport(),
            'engineers' => User::getRole('it'),
            'edit' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PacsSupportRequest $request, PacsSupportService $pacsSupportService)
    {
        DB::transaction(function () use ($request, $pacsSupportService) {
            $pacsSupportService->createPacsSupport($request);
            $pacsSupportService->createEngineers($request);
        });

        session()->flash('success', 'Data Troubleshooting telah berhasil dibuat!');
        return redirect('pacs_supports');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PacsSupport  $pacsSupport
     * @return \Illuminate\Http\Response
     */
    public function show(PacsSupport $pacsSupport)
    {
        $engineers = (new PacsSupportService())->getEngineers($pacsSupport);
        return view('pacs.supports.show', compact('pacsSupport', 'engineers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PacsSupport  $pacsSupport
     * @return \Illuminate\Http\Response
     */
    public function edit(PacsSupport $pacsSupport)
    {
        $support = $pacsSupport;
        $edit = true;
        return view('pacs.supports.edit', compact('support', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PacsSupport  $pacsSupport
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePacsSupportRequest $request, PacsSupport $pacsSupport)
    {
        $pacsSupport->update($request->all());
        session()->flash('success', 'Data telah berhasil diperbarui!');
        return redirect('pacs_supports');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PacsSupport  $pacsSupport
     * @return \Illuminate\Http\Response
     */
    public function destroy(PacsSupport $pacsSupport)
    {
        $pacsSupport->delete();
        PacsEngineer::query()
            ->where('engineerable_type', 'App\PacsSupport')
            ->where('engineerable_id', $pacsSupport->id)
            ->delete();

        session()->flash('success', 'Data telah berhasil dihapus!');
        return redirect('pacs_supports');
    }
}
