<?php

namespace App\Http\Controllers;

use App\Demo;
use App\Offer;
use App\OfferProgress;
use App\Http\Requests\OfferProgressRequest;

class ProgressController extends Controller
{

    public function create(Offer $offer)
    {
        return view('progress.create', [
            'offer' => $offer,
        ]);
    }

    public function store(OfferProgress $progress, OfferProgressRequest $request)
    {
        $attr = $request->all();

        switch ($request->progress):
            case (50):
                $progress->update($attr);
                Demo::create([
                    'offer_progress_id' => $progress->id,
                    'date' => date('Y-m-d', strtotime($request->demo_date)),
                    'description' => $request->description,
                ]);
                break;

            case (100):
                $progress->update($attr);

                $request->validate([
                    'img' => 'required_if:progress,100|mimes:png,jpg,jpeg',
                ]);
                $progress
                    ->addMediaFromRequest('img')
                    ->usingFileName(date('YmdHi_PO'))
                    ->toMediaCollectionFromRemote('image_po');
                break;
            default:
                $progress->update($attr);

                $request->validate([
                    'img' => 'required_if:progress,100|mimes:png,jpg,jpeg',
                ]);
        endswitch;

        session()->flash('success', 'Progress Penawaran berhasil di update!');

        return redirect('offers');
    }
}
