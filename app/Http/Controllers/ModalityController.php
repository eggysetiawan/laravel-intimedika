<?php

namespace App\Http\Controllers;

use App\DataTables\ModalityDataTable;
use App\Http\Requests\ModalityRequest;
use App\Modality;
use Illuminate\Support\Str;

class ModalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ModalityDataTable $dataTable)
    {
        return $dataTable->render('modalities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modalities.create', [
            'modality' => new Modality(),
        ]);
    }


    public function store(ModalityRequest $request)
    {
        $attr = $request->all();
        $attr['slug'] = Str::slug(request('name'));

        Modality::create($attr);

        session()->flash('success', 'Alat berhasil di tambahkan!');
        return redirect('modalities');
    }
    public function edit(Modality $modality)
    {
        return view('modalities.edit', compact('modality'));
    }

    public function update(ModalityRequest $request, Modality $modality)
    {
        $attr = $request->all();

        $modality->update($attr);

        // alert success
        session()->flash('success', $modality->name . ' berhasil di Update!');

        return redirect('modalities');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Modality  $modality
     * @return \Illuminate\Http\Response
     */
    public function show(Modality $modality)
    {

        return view('modalities.show', compact('modality'));
    }

    public function destroy(Modality $modality)
    {
        // not used
    }
}
