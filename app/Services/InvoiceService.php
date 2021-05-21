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

    public function getPrice($request, $order)
    {
        if (!isset($request->price[$order->id])) {
            return $order->price;
        }

        return str_replace([",", "_"], "", $request->price[$order->id]);
    }

    public function repeatInvoice($invoice)
    {
        return $this->invoice_create = Invoice::create([
            'offer_id' => $invoice->offer_id,
            'date' => now()->format('Y-m-d'),
        ]);
    }

    public function createOrderChart($invoice)
    {
        return  $invoice->chart()->create([
            'user_id' => $invoice->offer->user_id,
            'sales_name' => $invoice->offer->author->name,
            'price' => $this->price_po,
            'is_approved' => 0,
            'year' => $invoice->offer->offer_date->format('Y'),
            'offer_date' => $invoice->offer->offer_date->format('Y-m-d'),
            'invoice_date' => $invoice->date->format('Y-m-d'),
            'is_approved' => 1

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

            // $price = isset($request->price[$order->id]) ? str_replace([",", "_"], "", $request->price[$order->id]) : $order->price;
            $price = $this->getPrice($request, $order);

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

        $shipping = isset($this->shipping) ?
            str_replace([",", "_"], "", $this->shipping)
            : 0;

        $main_modality = strtolower($offer->invoices->first()->orders->first()->modality->category);

        if ($main_modality == 'software') {
            $komisi_percentage = 3;
            $komisi = ($this->price_po - $shipping) * (3 / 100);
        }

        if ($main_modality != 'software') {
            $komisi_percentage = 1;
            $komisi = ($this->price_po - $shipping) * (1 / 100);
        }



        $cn_percentage = $offer->taxes->first()->cn_percentage;
        $cn = ($this->price_po - $shipping) * ($offer->taxes->first()->cn_percentage / 100);

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
