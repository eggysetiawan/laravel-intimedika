<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Http\Requests\OfferNoteRequest;

class OfferNoteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Offer $offer, OfferNoteRequest $request)
    {
        $offer->update([
            'form_note' => $request->form_note,
        ]);

        session()->flash('success', 'Keterangan Form Penawaran telah berhasil diubah!');
        return back();
    }
}
