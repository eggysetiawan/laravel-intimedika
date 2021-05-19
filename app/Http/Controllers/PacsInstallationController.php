<?php

namespace App\Http\Controllers;

use App\User;
use App\Hospital;
use App\PacsInstallation;
use Illuminate\Support\Facades\DB;
use App\Services\PacsInstallationService;
use App\DataTables\PacsInstallationDataTable;
use App\Http\Requests\PacsInstallationRequest;

class PacsInstallationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PacsInstallationDataTable $pacsInstallationDataTable)
    {
        return $pacsInstallationDataTable->render('pacs.installation.index', [
            'hospitals' => Hospital::intiwidHospital(),
        ]);
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
            if ($request->has('img')) {
                $pacsInstallationService->uploadFiles();
            }
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
    public function update(PacsInstallationRequest $request, PacsInstallation $pacsInstallation)
    {
        $attr = $request->all();
        $attr['slug'] = $pacsInstallation->slug;
        $attr['handover_date'] = date('Y-m-d H:i:s', strtotime($request->handover_date));
        $attr['start_installation_date'] = date('Y-m-d H:i:s', strtotime($request->start_installation_date));
        $attr['training_date'] = date('Y-m-d H:i:s', strtotime($request->training_date));
        $attr['finish_installation_date'] = date('Y-m-d H:i:s', strtotime($request->finish_installation_date));

        DB::transaction(
            function () use ($attr, $request, $pacsInstallation) {
                $pacsInstallation->update($attr);
                $pacsInstallation->stakeholder()->update([
                    'radiology_name' => $request->radiology_name,
                    'radiographer_name' => $request->radiographer_name,
                    'phone_radiology' => $request->phone_radiology,
                    'email_radiology' => $request->email_radiology,
                    'it_hospital_name' => $request->it_hospital_name,
                    'phone_it' => $request->phone_it,
                    'email_it' => $request->email_it,
                    'phone_radiographer' => $request->phone_radiographer,
                    'email_radiographer' => $request->email_radiographer,
                ]);

                foreach ($request->pacs_engineers as $engineer) {
                    $pacsInstallation->engineers()->update([
                        'engineerable_id' => $pacsInstallation->id,
                        'engineerable_type' => 'App\PacsInstallation',
                        'user_id' => $engineer,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $pacsInstallation
                    ->addMultipleMediaFromRequest(['img'])
                    ->each(function ($fileAdder) {
                        $fileAdder->toMediaCollection('files');
                    });
            }
        );


        session()->flash('success', 'Instalasi telah berhasil diedit');
        return redirect('pacs_installations');
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
