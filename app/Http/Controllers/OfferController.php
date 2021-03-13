<?php

namespace App\Http\Controllers;

use App\Modality;
use App\DataTables\OfferDataTable;
use App\Http\Requests\OfferRequest;
use App\{Offer, Customer};
use App\Events\OfferCreated;
use App\Events\OfferUpdated;
use App\Http\Requests\UpdateOfferRequest;
use App\Services\OfferService;

class OfferController extends Controller
{
    public function index(OfferDataTable $dataTable, Offer $offer)
    {
        return $dataTable->render('offers.index', [
            'approval' => 0,
            'offer_approval_count' => $offer
                ->with(['customer.hospitals', 'author', 'invoices.orders', 'progress.demo', 'invoices.tax'])
                ->whereNull('is_approved')
                ->count(),
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

    public function create()
    {
        $customers = Customer::with('hospitals')
            ->orderBy('name', 'asc')
            ->get();

        return view('offers.create', [
            'offer' => new Offer(),
            'customers' => $customers,
            'modalities' => Modality::orderBy('name', 'asc')->get(),
            'count' => request('count'),
            'max' => Offer::maxOfferNo(),
        ]);
    }



    public function store(OfferRequest $request, OfferService $offerService)
    {
        // to offers table
        $offer = $offerService->insertOffer($request);
        // to invoices table
        $invoice = $offerService->insertInvoice($offer, $request);
        // to offer_progress table
        $offerService->insertProgress($offer, $request);
        // to orders table
        $offerService->insertOrder($request, $invoice);
        // send mail to admin via event & listener
        event(new OfferCreated($offer));
        // alert success
        session()->flash('success', 'Penawaran telah berhasil dibuat!');
        return redirect('offers');
    }

    public function edit(Offer $offer)
    {
        $customers = Customer::with('hospitals')
            ->orderBy('name', 'asc')
            ->get();
        $modalities = Modality::orderBy('name', 'asc', 'price')->get();

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
