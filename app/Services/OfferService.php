<?php

namespace App\Services;

use App\Order;

class OfferService
{

    public function insertOffer($request)
    {
        // convert month romawi
        $attr = $request->all();

        $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");

        // offer_no
        $queue = str_pad($request->queue, 3, '0', STR_PAD_LEFT);
        // acronym
        $initial = auth()->user()->initial;
        $bln = $array_bln[date('n', strtotime($request->date))];
        $tahun = date('Y', strtotime($request->date));

        $attr['offer_no'] = 'Q-' . $queue . '/IPI/' . $initial . '/' . $bln . '/' . $tahun;
        $attr['slug'] = 'Q-' . $queue . '-IPI-' . $initial . '-' . $bln . '-' . $tahun;


        $date = date('Y-m-d', strtotime($request->date));;
        $attr['offer_date'] = $date;
        $attr['customer_id'] = $request->customer;

        return auth()->user()->offers()->create($attr);
    }

    public function insertInvoice($offer, $request)
    {
        return  $offer->invoices()->create([
            'date' => date('Y-m-d', strtotime($request->date)),
        ]);
    }

    public function insertProgress($offer, $request)
    {
        return $offer->progress()->create([
            'progress' => 30,
            'progress_date' => date('Y-m-d', strtotime($request->date)),
            'status' => 'On Progress',
        ]);
    }

    public function insertOrder($request, $invoice)
    {
        $order = [];
        foreach ($request->modality as $i => $v) {
            // to table orders
            $order = Order::insert([
                'invoice_id' => $invoice->id,
                'modality_id' => $request->modality[$i],
                'price' => str_replace(".", "", $request->price[$i]),
                'references' => $request->references[$i],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]);
        }
        return $order;
    }

    public function updateOrder($offer, $request)
    {
        $order = [];
        foreach ($offer->invoices->last()->orders as $i => $order) {
            // to table orders
            $order = $order->update([
                'modality_id' => $request->modality[$i],
                'price' => str_replace(".", "", $request->price[$i]),
                'references' => $request->references[$i],
                'updated_at' => now()->toDateTimeString(),
            ]);
        }
        return $order;
    }
}
