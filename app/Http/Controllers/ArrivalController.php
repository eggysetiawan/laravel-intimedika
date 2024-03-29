<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArrivalRequest;
use App\Visit;

class ArrivalController extends Controller
{

    public function edit(Visit $visit)
    {
        return view('arrival.edit', compact('visit'));
    }


    public function update(ArrivalRequest $request, Visit $visit)
    {
        $attr  = $request->validated();

        // update table customers
        $visit->customer()->update([
            'role' => $request->role,
        ]);

        // update table visits
        $attr['is_visited'] = 1;
        $visit->update($attr);

        // insert image to media table
        if (request('img')) {
            $imgSlug = uniqid() . '.' . request()->file('img')->extension();
            $visit
                ->addMediaFromRequest('img')
                ->usingFileName($imgSlug)
                ->toMediaCollection('images');
        }

        session()->flash('success', 'Kunjungan Berhasil di Buat!');
        return redirect('visits');
    }
}
