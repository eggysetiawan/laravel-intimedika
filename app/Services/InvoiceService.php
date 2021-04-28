<?php

namespace App\Services;

use App\{Invoice, Order, Tax};


class InvoiceService
{
    private
        $invoice_create,
        $ppn,
        $shipping,
        $price_po;

    public function repeatInvoice($invoice)
    {
        return $this->invoice_create = Invoice::create([
            'offer_id' => $invoice->offer_id,
            'date' => now()->format('Y-m-d'),
        ]);
    }

    public function uploadPO($request)
    {
        $request->validate([
            'img' => ['required', 'image', 'mimes:png,jpg,jpeg,pdf'],
        ]);

        // to media tables
        $fileName = uniqid() . '.' . request()->file('img')->extension();

        return $this->invoice_create
            ->addMediaFromRequest('img')
            ->usingFileName($fileName)
            ->toMediaCollection('image_po');
    }

    public function insertOrder($request)
    {

        $invoice = $this->invoice_create;
        $orders = Order::whereIn('id', $request->id_order);

        $price_po = 0;
        $insert = [];
        $orders->each(function ($order, $i) use ($invoice, $request, &$price_po, &$insert) {

            $price = isset($request->price[$order->id]) ? str_replace([",", "_"], "", $request->price[$order->id]) : $price = $order->price;

            $insert =  $order->insert([
                'invoice_id' => $invoice->id,
                'modality_id' => $order->modality_id,
                'price' => $price,
                'quantity' => $request->qty[$order->id],
                'references' => $order->references,
                'created_at' => now()->format('Y-m-d H:i:s'),
                'updated_at' => now()->format('Y-m-d H:i:s'),
            ]);
            $price_po += $price * $request->qty[$order->id];
        });

        $this->price_po = $price_po;
        $this->ppn = ($price_po * (10 / 100));
        $this->shipping = isset($request->shipping) ? $request->shipping : 0;

        return $insert;
    }

    public function updatePrice($offer, $request)
    {
        $orders = $offer->fixPrices->whereIn('order_id', $request->id_order);

        $fix_price = [];
        $orders->each(function ($order, $i) use ($request, &$fix_price) {
            $price = isset($request->price[$order->order_id]) ? str_replace(",", "", $request->price[$order->order_id]) : $order->price;
            $fix_price = $order->update([
                'price' => $price,
                'updated_at' => now()->toDateString(),
            ]);
        });

        return $fix_price;
    }

    public function createTax($offer)
    {

        $main_modality = strtolower($offer->invoices->first()->orders->first()->modality->category);

        if ($main_modality == 'software') {
            $komisi_percentage = 3;
            $komisi = $this->price_po * (3 / 100);
        }

        if ($main_modality != 'software') {
            $komisi_percentage = 1;
            $komisi = $this->price_po * (1 / 100);
        }

        $shipping = isset($this->shipping) ?
            str_replace([",", "_"], "", $this->shipping)
            : 0;

        $cn_percentage = $offer->taxes->first()->cn_percentage;
        $cn = $this->price_po * ($offer->taxes->first()->cn_percentage / 100);

        return Tax::create([
            'offer_id' => $offer->id,
            'invoice_id' => $this->invoice_create->id,
            'price_po' => $this->price_po,
            'dpp' => $this->price_po,
            'ppn' => $this->ppn,
            'nett' => $this->price_po,
            'cn' => $cn,
            'cn_percentage' => $cn_percentage,
            'komisi' => $komisi,
            'komisi_percentage' => $komisi_percentage,
            'shipping' => $shipping,
        ]);
    }
}
