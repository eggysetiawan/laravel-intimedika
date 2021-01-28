<?php

namespace App\Http\Controllers;

use App\Hospital;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\DataTables\HospitalDataTable;
use App\Http\Requests\HospitalRequest;

class HospitalController extends Controller
{

    public function index(HospitalDataTable $dataTable)
    {
        return $dataTable->render('hospitals.index');
    }
    public function filter(HospitalDataTable $dataTable)
    {
        $from = date('Y-m-d', strtotime(request('from')));
        $to = date('Y-m-d', strtotime(request('to')));

        return $dataTable->with([
            'from' => $from,
            'to' => $to,
        ])
            ->render('hospitals.index');
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
