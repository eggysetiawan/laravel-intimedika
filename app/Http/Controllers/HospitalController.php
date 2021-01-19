<?php

namespace App\Http\Controllers;

use App\Hospital;
use App\Http\Requests\HospitalRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::where('name', '!=', '')->latest()->paginate(10);
        return view('hospitals.index', compact('hospitals'));
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

        return redirect('visits/add');
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
}
