<?php

namespace App\Http\Controllers;

use App\Tax;
use App\Demo;
use App\Offer;
use App\OfferProgress;
use App\DataTables\OfferDataTable;
use App\Events\PurchaseOrderCreated;
use App\Http\Requests\OfferProgressRequest;
use App\Services\ProgressService;

class ProgressController extends Controller
{


    public function approval(OfferDataTable $dataTable)
    {
        return $dataTable
            ->with([
                'approval_po' => true,
            ])
            ->render('offers.index', [
                'tableHeader' => 'Purchase Order is Ready to Approve',
                'approval' => OfferProgress::whereNull('is_approved')
                    ->where('progress', 99)
                    ->count(),
            ]);
    }

    public function create(Offer $offer)
    {
        abort_if($offer->progress->progress > 99, 403);
        return view('progress.create', [
            'offer' => $offer,
        ]);
    }

    public function update(Offer $offer, OfferProgressRequest $request, ProgressService $progressService)
    {
        $attr = $request->all();
        switch ($request->progress):
            case (50):
                $offer->progress->update($attr);
                $progressService->createDemo($offer, $request);
                break;
            case (99):
                $progressService->updateOrder($offer, $request);
                $progressService->createTax($offer, $request);
                $offer->progress->update($attr);
                $progressService->uploadPurchase($offer, $request);
                event(new PurchaseOrderCreated($offer));
                break;
            default:
                $offer->progress->update($attr);
        endswitch;

        session()->flash('success', 'Progress Penawaran berhasil di update!');

        return redirect('offers');
    }
}
