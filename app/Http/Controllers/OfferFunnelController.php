<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Funnel;
use App\Modality;
use App\Events\OfferCreated;
use App\Services\OfferService;
use App\Services\OfferFunnelService;
use App\Http\Requests\OfferFunnelRequest;

class OfferFunnelController extends Controller
{

    public function edit(Funnel $funnel)
    {
        // abort_if($funnel->progress < 100, 401);
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
        $offer = $funnel->offer;
        // to offers table
        $offerFunnelService->updateOffer($offer, $request);
        // to invoices table
        $offerFunnelService->updateInvoice($offer, $request);
        // to offer_progress table
        $offerFunnelService->updateProgress($offer, $request);
        // to orders table
        $offerFunnelService->updateOrder($offer, $request);
        // to fix price table
        $offerFunnelService->insertService($offer, $request);
        // update funnel progress
        $offerFunnelService->updateProgressFunnel($funnel);

        event(new OfferCreated($offer));


        session()->flash('success', 'Penawaran telah berhasil dibuat!');
        return redirect('funnels');
    }
}
