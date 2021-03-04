<?php

namespace App\Http\Controllers;

use App\Tax;
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
            'price.*' => 'nullable',
        ]);

        // to media tables
        $fileName = date('YmdHi') . '.' . request()->file('img')->extension();
        $invoice_create
            ->addMediaFromRequest('img')
            ->usingFileName($fileName)
            ->toMediaCollection('image_po');

        // get order
        $orders = Order::whereIn('id', $request->id_order);
        $price_po = 0;
        $orders->each(function ($order, $i) use ($invoice_create, $request, &$price_po) {

            $price = isset($request->price[$order->id]) ? str_replace(".", "", $request->price[$order->id]) : $price = $order->price;

            $order->insert([
                'invoice_id' => $invoice_create->id,
                'modality_id' => $order->modality_id,
                'price' => $price,
                'quantity' => $request->qty[$order->id],
                'references' => $order->references,
                'created_at' => now()->format('Y-m-d H:i:s'),
                'updated_at' => now()->format('Y-m-d H:i:s'),
            ]);
            // price_po yang dibawah ini mau dipakai diluar
            $price_po += $price * $request->qty[$order->id];
        });

        // disini
        $ppn = ($price_po * (10 / 100));

        $shipping = isset($request->shipping) ? $request->shipping : 0;

        Tax::create([
            'invoice_id' => $invoice_create->id,
            'price_po' => $price_po,
            'dpp' => $price_po,
            'ppn' => $ppn,
            'nett' => $price_po,
            'shipping' => str_replace(".", "", $shipping),
        ]);



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
