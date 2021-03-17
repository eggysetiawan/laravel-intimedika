<?php

namespace App\Http\Controllers;

use App\Tax;
use App\Offer;
use App\Order;
use App\Invoice;
use App\Services\InvoiceService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function repeat(Invoice $invoice, Request $request, InvoiceService $invoiceService)
    {
        $invoiceService->repeatInvoice($invoice, $request);
        $invoiceService->uploadPO($request);
        $invoiceService->insertOrder($request);
        $invoiceService->createTax();

        session()->flash('success', 'Repeat order berhasil!');
        return back();
    }

    public function show(Offer $offer)
    {
        $prices = array();

        $order_first[] = $offer->invoices->first()->orders;

        return view('invoices.show', [
            'offer' => $offer,
            'prices' => $prices,
            'order_first' => $order_first,
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
