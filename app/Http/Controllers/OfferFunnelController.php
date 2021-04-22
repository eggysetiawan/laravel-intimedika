<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Funnel;
use App\Modality;
use App\Services\OfferFunnelService;
use App\Http\Requests\OfferFunnelRequest;

class OfferFunnelController extends Controller
{

    public function edit(Funnel $funnel)
    {
        $funnel->load(['offer.invoices.orders.modality']);

        return view('funnels.create-offer', [
            'funnel' => $funnel,
            'offer' => $funnel->offer,
            'i' => 0,
            'modalities' => Modality::selectModality(),
        ]);
    }

    public function update(Funnel $funnel, OfferFunnelRequest $request, OfferFunnelService $offerFunnelService)
    {

        $offerFunnelService->createOffer($funnel, $request);

        session()->flash('success', 'Penawaran telah berhasil dibuat!');
        return view('funnels');
    }
}
