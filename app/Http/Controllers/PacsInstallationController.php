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
            'pacs' => new PacsInstallation(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PacsInstallationRequest $request)
    {
        $attr = $request->all();
        $hospital_name = Hospital::findOrFail(request('hospital'))->name;
        $attr['slug'] = Str::slug($hospital_name . ' ' . now()->format('Y'));
        $attr['handover_date'] = date('Y-m-d H:i:s', strtotime($request->handover_date));
        $attr['start_installation_date'] = date('Y-m-d H:i:s', strtotime($request->start_installation_date));
        $attr['training_date'] = date('Y-m-d H:i:s', strtotime($request->training_date));
        $attr['finish_installation_date'] = date('Y-m-d H:i:s', strtotime($request->finish_installation_date));
        $attr['hospital_id'] = $request->hospital;

        DB::transaction(function () use ($attr, $request) {
            $pacs_installations = auth()->user()->pacs_installs()->create($attr);
            $pacs_installations->stakeholder()->create($attr);

            foreach ($request->pacs_engineers as $engineer) {
                PacsEngineer::insert([
                    'engineerable_id' => $pacs_installations->id,
                    'engineerable_type' => 'App\PacsInstallation',
                    'user_id' => $engineer,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $pacs_installations
                ->addMultipleMediaFromRequest(['img'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('files');
                });
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
