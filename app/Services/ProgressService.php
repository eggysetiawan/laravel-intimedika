<?php

namespace App\Services;


use App\{Demo, Tax};

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

        $komisi_3_percent = $this->price_po * (3 / 100);
        $komisi_1_percent = $this->price_po * (1 / 100);

        $komisi = $main_modality == 'software' ?
            $komisi_3_percent :
            $komisi_1_percent;

        $shipping = isset($request->shipping) ?
            $request->shipping
            : 0;

        $cn = $this->price_po * ($request->cn / 100);

        return Tax::create([
            'invoice_id' => $offer->invoices->first()->id,
            'price_po' => $this->price_po,
            'dpp' => $this->price_po,
            'ppn' => $this->ppn,
            'nett' => $this->price_po,
            'cn' => $cn,
            'komisi' => $komisi,
            'shipping' => str_replace([",", "_"], "", $shipping),
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
