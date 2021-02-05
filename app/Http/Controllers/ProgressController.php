<?php

namespace App\Http\Controllers;

use App\Demo;
use App\Offer;
use App\OfferProgress;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;

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
        switch (request('progress')):
            case (50):
                $progress->update([
                    'progress' => request('progress'),
                    'status' => request('status'),
                ]);

                Demo::create([
                    'date' => request('demo_date'),
                    'description' => request('description'),
                ]);

                break;

            default:
                $progress->update([
                    'progress' => $request->progress,
                    'status' => $request->status,
                    'price_po' => $request->price_po,
                    'shipping' => $request->shipping,
                    'detail' => $request->detail,
                ]);
        endswitch;
    }
}
