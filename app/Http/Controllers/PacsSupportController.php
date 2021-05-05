<?php

namespace App\Http\Controllers;

use App\User;
use App\Hospital;
use App\PacsSupport;
use App\PacsEngineer;
use App\PacsInstallation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\PacsSupportDataTable;
use App\Http\Requests\PacsSupportRequest;
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
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PacsSupportRequest $request)
    {
        $attr = $request->all();
        $hospital_name = PacsInstallation::hospitalRequest($request);

        $attr['slug'] = Str::slug($hospital_name . '-' . uniqid());
        $attr['pacs_installation_id'] = $request->pacs_installation;

        DB::transaction(function () use ($request, $attr) {
            $pacs_supports = auth()->user()->pacs_supports()->create($attr);

            foreach ($request->pacs_engineers as $engineer) {
                PacsEngineer::insert([
                    'engineerable_id' => $pacs_supports->id,
                    'engineerable_type' => 'App\PacsSupport',
                    'user_id' => $engineer,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
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
