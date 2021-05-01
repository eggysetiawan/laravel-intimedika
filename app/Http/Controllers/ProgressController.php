<?php

namespace App\Http\Controllers;


use App\Offer;
use App\OfferProgress;
use App\Services\ProgressService;
use App\DataTables\OfferDataTable;
use Illuminate\Support\Facades\DB;
use App\Events\PurchaseOrderCreated;
use App\Http\Requests\OfferProgressRequest;

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
                'approval' => OfferProgress::readyToApprove(),
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

        DB::transaction(function () use ($request, $offer, $progressService) {
            $attr = $request->all();

            switch ($request->progress):
                case (50):
                    $offer->progress->update($attr);
                    $progressService->createDemo($offer, $request);
                    break;

                case (99):
                    $progressService->updateOrder($offer, $request);
                    $progressService->updatePrice($offer, $request);
                    $progressService->createTax($offer, $request);
                    $offer->progress->update($attr);
                    $progressService->uploadPurchase($offer, $request);
                    $progressService->updateOrderId($offer);
                    event(new PurchaseOrderCreated($offer));
                    break;

                default:
                    $offer->progress->update($attr);
            endswitch;
        });



        session()->flash('success', 'Progress Penawaran berhasil di update!');
        return redirect('offers');
    }
}
