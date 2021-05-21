<?php

namespace App\Http\Controllers;

use App\Hospital;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Http;
use App\DataTables\HospitalDataTable;
use App\Http\Requests\HospitalRequest;

class HospitalController extends Controller
{

    public function index(HospitalDataTable $dataTable)
    {
        return $dataTable->render('hospitals.index');
    }

    public function create()
    {
        return view('hospitals.create', [
            'hospital' => new Hospital(),
            'provinces' => Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')['provinsi'],
            'districts' => Http::get('https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=32')['kota_kabupaten']

        ]);
    }

    public function district()
    {
        $districts = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=' . request('select'))['kota_kabupaten'];
        return response()->json($districts);
    }

    public function store(HospitalRequest $request)
    {
        $attr = $request->all();
        $attr['slug'] = Str::slug(request('name'));

        Hospital::create($attr);

        session()->flash('success', 'Rumah Sakit berhasil di buat!');
        return redirect('hospitals');
    }

    public function edit(Hospital $hospital)
    {
        $provinces = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')['provinsi'];
        return view('hospitals.edit', compact('hospital', 'provinces'));
    }

    public function update(HospitalRequest $request, Hospital $hospital)
    {
        $hospital->update($request->all());
        session()->flash('success', 'Rumah Sakit berhasil di Update!');

        return redirect('hospitals');
    }

    public function show(Hospital $hospital)
    {
    }

    public function destroy(Hospital $hospital)
    {
        $hospital->delete();
        session()->flash('success', 'data berhasil di hapus!');
        return redirect('hospitals');
    }
}
