<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Order;
use App\Invoice;

class InvoiceController extends Controller
{
    public function repeat(Invoice $invoice)
    {
        $invoice_create = Invoice::create([
            'offer_id' => $invoice->offer_id,
            'date' => now()->format('Y-m-d'),
        ]);

        $orders = Order::where('invoice_id', $invoice->id)
            ->get();

        foreach ($orders as $order) {
            Order::insert([
                'invoice_id' => $invoice_create->id,
                'modality_id' => $order->modality_id,
                'price' => $order->price,
                'quantity' => $order->quantity,
                'references' => $order->references,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        session()->flash('success', 'Repeat order berhasil!');
        return redirect('offers');
    }

    public function show(Offer $offer)
    {
        return view('invoices.show', compact('offer'));
    }
    public function print(Offer $offer)
    {
        return view('invoices.print', compact('offer'));
    }
}
