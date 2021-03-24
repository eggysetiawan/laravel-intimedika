<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepeatRequest;
use App\Offer;
use App\Invoice;
use App\Services\InvoiceService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function repeat(Invoice $invoice, RepeatRequest $request, InvoiceService $invoiceService)
    {
        $invoiceService->repeatInvoice($invoice, $request);
        $invoiceService->uploadPO($request);
        $invoiceService->insertOrder($request);
        $invoiceService->updatePrice($invoice->offer, $request);
        $invoiceService->createTax();

        session()->flash('success', 'Repeat order berhasil!');
        return back();
    }

    public function show(Offer $offer)
    {
        return view('invoices.show', [
            'offer' => $offer->load(['invoices.orders.modality', 'author',  'customer', 'progress']),
        ]);
    }
    public function toOrder(Offer $offer)
    {
        return view('invoices.show', [
            'offer' => $offer,
            'tab' => true
        ]);
    }
    public function print(Offer $offer)
    {
        return view('invoices.print', compact('offer'));
    }
}
