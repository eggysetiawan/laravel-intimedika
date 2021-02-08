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

            case (99):
                $progress->update($attr);

                $request->validate([
                    'img' => 'required_if:progress,99|mimes:png,jpg,jpeg',
                ]);
                $imgName = date('YmdHi') . '.' . request()->file('img')->extension();
                $progress
                    ->addMediaFromRequest('img')
                    ->usingFileName($imgName)
                    ->toMediaCollection('image_po');
                break;


            default:
                $request->validate([
                    'img' => 'required_if:progress,99|mimes:png,jpg,jpeg',
                ]);
                $progress->update($attr);


        endswitch;

        session()->flash('success', 'Progress Penawaran berhasil di update!');

        return redirect('offers');
    }
}
