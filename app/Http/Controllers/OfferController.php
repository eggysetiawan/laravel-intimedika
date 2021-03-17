<?php

namespace App\Http\Controllers;

use App\Modality;
use App\DataTables\OfferDataTable;
use App\Http\Requests\OfferRequest;
use App\{Offer, Customer};
use App\Events\OfferCreated;
use App\Events\OfferUpdated;
use App\Http\Requests\UpdateOfferRequest;
use App\Services\FilterService;
use App\Services\OfferService;

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
            'fromDate' => date('Y-m-d'),
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
        // to offers table
        $offer = $offerService->createOffer($request);
        // to invoices table
        $offerService->createInvoice($request);
        // to offer_progress table
        $offerService->createProgress($request);
        // to orders table
        $offerService->insertOrder($request);
        // send mail to admin via event & listener
        event(new OfferCreated($offer));
        // alert success
        session()->flash('success', 'Penawaran telah berhasil dibuat!');
        return redirect('offers');
    }

    public function edit(Offer $offer)
    {
        $customers = Customer::selectCustomer();
        $modalities = Modality::selectModality();

        return view('offers.edit', compact('offer', 'customers', 'modalities'));
    }

    public function update(UpdateOfferRequest $request, Offer $offer, OfferService $offerService)
    {
        $attr = $request->all();
        // update orders table
        $offerService->updateOrder($offer, $request);
        // update offer table
        $offer->update($attr);
        // send mail to admin via event & listener
        event(new OfferUpdated($offer));
        // alert success
        session()->flash('success', 'Penawaran telah berhasil di update!');
        return redirect('offers');
    }

    public function destroy(Offer $offer)
    {
        $this->authorize('delete', $offer);
        $offer->delete();
        session()->flash('success', 'data telah berhasil di hapus!');
        return redirect('offers');
    }
}
