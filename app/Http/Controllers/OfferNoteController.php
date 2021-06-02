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
        $attr = $request->validated();
        $attr['form_up'] = 1;
        $attr['has_form_note'] = 1;

        if (!$request->has('form_up')) {
            $attr['form_up'] = 0;
        }

        if (!$request->has('has_form_note')) {
            $attr['has_form_note'] = 0;
        }

        $offer->update($attr);

        session()->flash('success', 'Keterangan Form Penawaran telah berhasil diubah!');
        return back();
    }
}
