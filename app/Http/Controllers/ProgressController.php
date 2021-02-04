<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;

class ProgressController extends Controller
{

    public function create(Offer $offer)
    {
        return view('progress.create', compact('offer'));
    }
}
