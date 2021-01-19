<?php

namespace App\Http\Controllers;

use App\Hospital;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::where('name', '!=', '')->orderBy('name', 'asc')->paginate(10);
        return view('hospitals.index', compact('hospitals'));
    }

    public function create()
    {
        return view('hospitals.create', [
            'hospital' => new Hospital(),
        ]);
    }

    public function store()
    {
        $attr = $this->validateRequest();
        $attr['slug'] = Str::slug(request('name'));
        $attr['code'] = request('code');
        $attr['class'] = request('class');
        $attr['email'] = request('email');
        Hospital::create($attr);

        // alert success
        session()->flash('success', 'Rumah Sakit berhasil di buat!');

        return redirect('visits/add');
    }

    public function validateRequest()
    {
        return request()->validate(
            [
                'name' => 'required',
                'phone' => 'required|numeric',
                'city' => 'required',
                'address' => 'required',
            ],
            [
                'name.required' => 'Nama Rumah Sakit wajib diisi!',
                'phone.required' => 'Nomor Tlp wajib diisi!',
                'city.required' => 'Kota wajib diisi!',
                'address.required' => 'Alamat wajib diisi!',
            ]
        );
    }
}
