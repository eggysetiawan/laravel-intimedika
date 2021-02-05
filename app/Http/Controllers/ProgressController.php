<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;
use App\OfferProgress;

class ProgressController extends Controller
{

    public function create(Offer $offer)
    {
        return view('progress.create', [
            'offer' => $offer,
        ]);
    }

    public function store(OfferProgress $progress)
    {
        switch (request('progress')):
            case (30):
                $progress->update([
                    'progress' => request('progress'),
                    'status' => request('status'),
                ]);
                break;
            case (50):
                $progress->update([
                    'progress' => request('progress'),
                    'status' => request('status'),
                ]);
                break;
            case (70):
                $progress->update([
                    'progress' => request('progress'),
                    'status' => request('status'),
                    'price_po' => request('price_po'),
                    'shipping' => request('shipping'),
                ]);
                break;
            case (85):
                $progress->update([
                    'progress' => request('progress'),
                    'status' => request('status'),
                    'price_po' => request('price_po'),
                    'shipping' => request('shipping'),
                ]);
                break;
            case (90):
                $progress->update([
                    'progress' => request('progress'),
                    'status' => request('status'),
                    'price_po' => request('price_po'),
                    'shipping' => request('shipping'),
                ]);
                break;

            default:
                $progress->update([
                    'progress' => request('progress'),
                    'status' => request('status'),
                    'price_po' => request('price_po'),
                    'shipping' => request('shipping'),
                ]);
        endswitch;
    }
}
