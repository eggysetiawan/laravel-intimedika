<?php

namespace App\Services;

use App\Demo;
use App\FixPriceOrder;
use App\Tax;
use Dompdf\Positioner\Fixed;

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
                'price' => str_replace(",", "", $request->price[$i]),
                'quantity' => $request->qty[$i],
            ]);
            $this->price_po += str_replace(",", "", $request->price[$i]) * $request->qty[$i];
        }
        return $order;

        $this->ppn = ($this->price_po * (10 / 100));
    }

    public function updatePrice($offer, $request)
    {
        $modalities = $offer->invoices->first()->orders->whereIn('id', $request->id_order)->pluck('modality_id');
        $modality_id = $modalities->all();
        $orders = $offer->fixPrices->whereIn('modality_id', $modality_id);
        $fix_price = [];
        $j = 0;

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

    public function createTax($offer, $request)
    {
        $shipping = isset($request->shipping) ? $request->shipping : 0;

        return Tax::create([
            'invoice_id' => $offer->invoices->first()->id,
            'price_po' => $this->price_po,
            'dpp' => $this->price_po,
            'ppn' => $this->ppn,
            'nett' => $this->price_po,
            'shipping' => str_replace(",", "", $shipping),
        ]);
    }

    public function uploadPurchase($offer, $request)
    {
        // insert image to media table
        $request->validate([
            'img' => 'required_if:progress,99|mimes:png,jpg,jpeg',
        ]);
        $imgName = uniqid() . '.' . request()->file('img')->extension();
        return $offer->invoices->first()
            ->addMediaFromRequest('img')
            ->usingFileName($imgName)
            ->toMediaCollection('image_po');
    }
}
