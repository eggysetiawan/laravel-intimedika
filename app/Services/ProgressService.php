<?php

namespace App\Services;


use App\{Demo, OrderChart, Tax};

class ProgressService
{
    private $price_po, $ppn;
    public function createDemo($offer, $request)
    {
        return Demo::create([
            'offer_progress_id' => $offer->progress->id,
            'date' => date('Y-m-d', strtotime($request->demo_date)),
            'description' => $request->description,
        ]);
    }

    public function updateOrder($offer, $request)
    {
        $orders = $offer->invoices->first()->orders
            ->whereIn('id', $request->id_order);
        $this->price_po = 0;

        $order = [];
        foreach ($orders as $i => $order) {
            $order->update([
                'price' => str_replace([",", "_"], "", $request->price[$i]),
                'quantity' => $request->qty[$i],
            ]);
            $this->price_po += str_replace([",", "_"], "", $request->price[$i]) * $request->qty[$i];
        }
        $this->ppn = ($this->price_po * (10 / 100));
        return $order;
    }

    public function updatePrice($offer, $request)
    {
        $modalities = $offer->invoices->first()->orders->whereIn('id', $request->id_order)->pluck('modality_id');
        $modality_id = $modalities->all();

        $j = 0;
        $fix_price = [];
        $orders = $offer->fixPrices->whereIn('modality_id', $modality_id);
        foreach ($orders as $i => $order) {
            $fix_price = $order->update([
                'price' => str_replace(",", "", $request->price[$j]),
                'order_id' => $request->id_order[$j],
                'updated_at' => now()->toDateString(),
            ]);
            $j++;
        }
        return $fix_price;
    }
    public function updateOrderId($offer)
    {
        $orders = $offer->invoices->first()->orders->pluck('id');
        $order_id = $orders->all();
        $fix_prices = $offer->fixPrices;

        $j = 0;
        $insert = [];
        $fix_prices->each(function ($fix_price, $i) use (&$order_id, &$insert, &$j) {
            $insert = $fix_price->update([
                'order_id' => $order_id[$j],
            ]);
            $j++;
        });
        return $insert;
    }

    public function createTax($offer, $request)
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

        $shipping = isset($request->shipping) ?
            str_replace([",", "_"], "", $request->shipping)
            : 0;

        $cn = $this->price_po * ($request->cn / 100);

        return Tax::create([
            'offer_id' => $offer->id,
            'invoice_id' => $offer->invoices->first()->id,
            'price_po' => $this->price_po,
            'dpp' => $this->price_po,
            'ppn' => $this->ppn,
            'nett' => $this->price_po,
            'cn' => $cn,
            'cn_percentage' => $request->cn,
            'komisi' => $komisi,
            'komisi_percentage' => $komisi_percentage,
            'shipping' => $shipping,
        ]);
    }

    public function createOrderChart($offer)
    {
        OrderChart::create([
            'user_id' => $offer->user_id,
            'invoice_id' => $offer->invoices->first()->id,
            'sales_name' => $offer->author->name,
            'price' => $this->price_po,
            'is_approved' => 0,
            'year' => $offer->offer_date->format('Y'),
            'offer_date' => $offer->offer_date->format('Y-m-d')
        ]);
    }

    public function uploadPurchase($offer, $request)
    {
        // insert image to media table
        $request->validate([
            'img' => ['required_if:progress,99', 'mimes:png,jpg,jpeg'],
        ]);
        $imgName = uniqid() . '.' . request()->file('img')->extension();
        return $offer->invoices->first()
            ->addMediaFromRequest('img')
            ->usingFileName($imgName)
            ->toMediaCollection('image_po');
    }
}
