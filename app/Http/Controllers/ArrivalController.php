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
        $attr  = $request->all();
        // update table customers
        $visit->customer()->update([
            'role' => $request->role,
        ]);
        // update table visits
        $attr['is_visited'] = 1;
        $visit->update($attr);
        // insert image to media table
        if (request('img')) :
            $slug = $visit->slug;
            $imgSlug = $slug . '.' . request()->file('img')->extension();

            $visit
                ->addMediaFromRequest('img')
                ->usingFileName($imgSlug)
                ->toMediaCollection('images');
        endif;
        // session
        session()->flash('success', 'Kunjungan Berhasil di Buat!');
        // redirect page
        return redirect('visits');
    }
}
