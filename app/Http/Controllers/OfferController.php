<?php

namespace App\Http\Controllers;

use App\Modality;
use App\{Offer, Customer};
use App\Events\OfferCreated;
use App\Events\OfferUpdated;
use App\Services\OfferService;
use App\Services\FilterService;
use App\DataTables\OfferDataTable;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OfferRequest;
use App\Http\Requests\UpdateOfferRequest;

class OfferController extends Controller
{
    public function index(OfferDataTable $dataTable, Offer $offer, FilterService $filterService)
    {
        return $dataTable->render('offers.index', [
            'approval' => 0,
            'offer_approval_count' => $offer
                ->with(['customer.hospitals', 'author', 'invoices.orders', 'progress.demo', 'invoices.tax'])
                ->whereNull('is_approved')
                ->count(),
            'fromDate' => $filterService->getOfferFromDate(),
        ]);
    }

    public function trash(OfferDataTable $dataTable)
    {
        return $dataTable->with([
            'trash' => true,
        ])
            ->render('offers.index', [
                'approval' => 0,
                'tableHeader' => 'Penawaran (Dihapus)',
            ]);
    }

    public function create(OfferService $offerService)
    {
        return view('offers.create', [
            'offer' => new Offer(),
            'customers' => Customer::selectCustomer(),
            'modalities' => Modality::selectModality(),
            'count' => request('count'),
            'max' => $offerService->maxOfferNo(),
        ]);
    }

    public function store(OfferRequest $request, OfferService $offerService)
    {

        DB::transaction(function () use ($request, $offerService) {
            // dd($request->queue . date('Y', strtotime($request->date)));
            // to offers table
            $offerService->createOffer($request);
            // to invoices table
            $offerService->createInvoice($request);
            // to offer_progress table
            $offerService->createProgress($request);
            // to orders table
            $offerService->insertOrder($request);
            // to orders table
            $offerService->insertFirstOffer();
            // to fix price table
            $offerService->insertPrice($request);
            // send mail to admin via event & listener
            $offerService->sendOfferEmailToDirector();
            // direct approve offer under 105/2020
            $offerService->directOffer();
        });

        // alert success
        session()->flash('success', 'Penawaran telah berhasil dibuat!');
        return redirect('offers');
    }

    public function edit(Offer $offer)
    {
        $customers = Customer::selectCustomer();
        $modalities = Modality::selectModality();
        $i = 0;

        return view('offers.edit', compact('offer', 'customers', 'modalities', 'i'));
    }

    public function update(UpdateOfferRequest $request, Offer $offer, OfferService $offerService)
    {
        DB::transaction(function () use ($request, $offer, $offerService) {
            $request->validated();
            // update orders table
            $offerService->updateOrder($offer, $request);
            $offerService->updateFirstOffer($offer, $request);
        });


        // update offer table
        $attr['is_approved'] = 0;
        $offer->update($attr);

        // send mail to admin via event & listener
        event(new OfferUpdated($offer));

        session()->flash('success', 'Penawaran telah berhasil di update!');
        return redirect('offers');
    }

    public function destroy(Offer $offer)
    {
        $this->authorize('delete', $offer);
        $offer->delete();
        session()->flash('success', 'Penawaran telah berhasil di hapus!');
        return redirect('offers');
    }
}
