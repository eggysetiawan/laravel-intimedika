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
        $attr = $request->all();
        $attr['form_up'] = 1;

        if (!$request->has('form_up')) {
            $attr['form_up'] = 0;
        }
        $offer->update($attr);

        session()->flash('success', 'Keterangan Form Penawaran telah berhasil diubah!');
        return back();
    }
}
