<?php

namespace App\Http\Controllers;

use App\Modality;
use Illuminate\Support\Str;

class ModalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modalities = Modality::latest()->paginate(5);
        return view('modalities.index', compact('modalities'));
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


    public function store()
    {
        $attr = $this->validateRequest();
        $attr['slug'] = Str::slug(request('name'));
        $attr['stock'] = request('stock');
        $attr['spec'] = request('spec');

        Modality::create($attr);

        // alert success
        session()->flash('success', 'Alat berhasil di tambahkan!');

        return redirect('modalities');
    }
    public function edit(Modality $modality)
    {
        return view('modalities.edit', compact('modality'));
    }

    public function update(Modality $modality)
    {
        $attr = $this->validateRequest();
        $attr['stock'] = request('stock');
        $attr['spec'] = request('spec');


        $modality->update($attr);

        // alert success
        session()->flash('success', $modality->name . ' berhasil di Update!');

        return redirect('modalities');
    }

    public function validateRequest()
    {
        return request()->validate(
            [
                'name' => 'required',
                'model' => 'required',
                'brand' => 'required',
                'category' => 'required',
                'reference' => 'required',
                'price' => 'required|numeric',
            ],
            // costumizing error message (optional)
            [
                'name.required' => 'Nama Alat wajib diisi!',
                'model.required' => 'Model Alat wajib diisi!',
                'brand.required' => 'Brand Alat wajib diisi!',
                'price.required' => 'Harga Alat wajib diisi!',
                'category.required' => 'Pilih kategori alat!',
                'reference.required' => 'Pilih referensi alat!',
                'price.numeric' => 'Harga Alat hanya berupa angka!',
            ]
        );
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
