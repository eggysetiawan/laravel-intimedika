<?php

namespace App\Http\Controllers;

use App\Events\RevisionCreated;
use App\Http\Requests\RevisionRequest;
use App\Offer;

class RevisionController extends Controller
{
    public function edit(Offer $offer)
    {
        return view('offers.revision', compact('offer'));
    }

    public function update(RevisionRequest $request, Offer $offer)
    {
        $attr = $request->all();
        $attr['is_called'] = $request->has('is_called');
        $offer->revision()->create($attr);

        $offer->update([
            'is_approved' => 3,
        ]);

        event(new RevisionCreated($offer));

        session()->flash('success', 'Permintaan revisi telah berhasil!');

        return redirect('offers');
    }
}
