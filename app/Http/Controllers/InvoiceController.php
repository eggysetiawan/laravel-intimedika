<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Order;
use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function repeat(Invoice $invoice, Request $request)
    {
        // to invoice tables
        $invoice_create = Invoice::create([
            'offer_id' => $invoice->offer_id,
            'date' => now()->format('Y-m-d'),
        ]);
        $request->validate([
            'img' => 'required|image|mimes:png,jpg,jpeg,pdf',
        ]);

        // to media tables
        $fileName = date('YmdHi') . '.' . request()->file('img')->extension();
        $invoice_create
            ->addMediaFromRequest('img')
            ->usingFileName($fileName)
            ->toMediaCollection('image_po');

        // get order
        $orders = Order::whereIn('id', $request->id_order);
        $orders->each(function ($order, $i) use ($invoice_create, $request) {
            $order->insert([
                'invoice_id' => $invoice_create->id,
                'modality_id' => $order->modality_id,
                'price' => $order->price,
                'quantity' => $request->qty[$order->id],
                'references' => $order->references,
                'created_at' => now()->format('Y-m-d H:i:s'),
                'updated_at' => now()->format('Y-m-d H:i:s'),
            ]);
        });







        // insert order repeat
        // foreach ($orders as $i => $order) {
        //     $order->insert([
        //         'invoice_id' => $invoice_create->id,
        //         'modality_id' => $order->modality_id,
        //         'price' => $order->price,
        //         'quantity' => $request->qty[$i],
        //         'references' => $order->references,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
        session()->flash('success', 'Repeat order berhasil!');
        return back();
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
