<?php

namespace App\Http\Controllers;

use App\DataTables\PacsInstallationDataTable;
use App\User;
use App\Hospital;
use App\PacsInstallation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PacsInstallationRequest;
use App\PacsEngineer;
use Illuminate\Support\Facades\DB;
use App\DataTables\QueryDataTable;
use App\Services\PacsInstallationService;

class PacsInstallationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PacsInstallationDataTable $pacsInstallationDataTable)
    {
        return $pacsInstallationDataTable->render('pacs.installation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pacs.installation.create', [
            'engineers' => User::getRole('it'),
            'pacsInstallation' => new PacsInstallation(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PacsInstallationRequest $request, PacsInstallationService $pacsInstallationService)
    {
        DB::transaction(function () use ($request, $pacsInstallationService) {
            $pacs_installations = $pacsInstallationService->createPacsInstallation($request);
            $pacs_installations->stakeholder()->create($request->all());
            $pacsInstallationService->insertEngineer($request);
            $pacsInstallationService->uploadFiles();
        });

        session()->flash('success', 'Instalasi telah berhasil dibuat');
        return redirect('pacs_installations');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PacsInstallation  $pacsInstallation
     * @return \Illuminate\Http\Response
     */
    public function show(PacsInstallation $pacsInstallation)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PacsInstallation  $pacsInstallation
     * @return \Illuminate\Http\Response
     */
    public function edit(PacsInstallation $pacsInstallation)
    {
        $pacsInstallation->load('engineers', 'stakeholder');
        return view('pacs.installation.edit', [
            'engineers' => User::getRole('it'),
            'pacsInstallation' => $pacsInstallation
        ]);
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
        $pacsInstallation->delete();
        session()->flash('success', 'Data telah berhasil dihapus!');
        return redirect('pacs_installations');
    }
}
