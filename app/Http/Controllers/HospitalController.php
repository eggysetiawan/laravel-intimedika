<?php

namespace App\Http\Controllers;

use App\DataTables\HospitalDataTable;
use App\Hospital;
use Illuminate\Support\Str;

use App\Http\Requests\HospitalRequest;
use Yajra\DataTables\Services\DataTable;

class HospitalController extends Controller
{

    public function index(HospitalDataTable $dataTable)
    {
        return $dataTable->render('hospitals.index');
        // $hospitals = Hospital::where('name', '!=', '')->latest()->get();
    }

    public function create()
    {
        return view('hospitals.create', [
            'hospital' => new Hospital(),
        ]);
    }

    public function store(HospitalRequest $request)
    {
        $attr = $request->all();
        $attr['slug'] = Str::slug(request('name'));
        Hospital::create($attr);

        // alert success
        session()->flash('success', 'Rumah Sakit berhasil di buat!');

        return redirect('hospitals');
    }

    public function edit(Hospital $hospital)
    {
        return view('hospitals.edit', compact('hospital'));
    }

    public function update(HospitalRequest $request, Hospital $hospital)
    {
        $attr = $request->all();
        $hospital->update($attr);
        session()->flash('success', 'Rumah Sakit berhasil di Update!');

        return redirect('hospitals');
    }

    public function destroy(Hospital $hospital)
    {
        $hospital->delete();
        session()->flash('success', 'data berhasil di hapus!');
        return redirect('hospitals');
    }
}
