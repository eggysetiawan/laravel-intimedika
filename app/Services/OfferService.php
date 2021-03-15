<?php

namespace App\Services;

use App\Offer;
use App\Order;

class OfferService
{
    protected $invoice, $offer;
    public function getDate($request)
    {
        return date('Y-m-d', strtotime($request->date));
    }

    public function maxOfferNo()
    {
        if (Offer::first()) {
            return Offer::where(function ($query) {
                $maxYear = $query->max('offer_date');
                return $query->where('offer_date', $maxYear);
            })
                ->max('offer_no');
        } else {
            return 'Belum ada penawaran dibuat.';
        }
    }

    public function createOffer($request)
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


        $date = $this->getDate($request);
        $attr['offer_date'] = $date;
        $attr['customer_id'] = $request->customer;

        $offer =  auth()->user()->offers()->create($attr);
        $this->offer = $offer;

        return $offer;
    }

    public function createInvoice($request)
    {
        $invoice = $this->offer->invoices()->create([
            'date' => $this->getDate($request),
        ]);
        $this->invoice = $invoice;
        return $invoice;
    }

    public function createProgress($request)
    {
        return $this->offer->progress()->create([
            'progress' => 30,
            'progress_date' => $this->getDate($request),
            'status' => 'On Progress',
        ]);
    }

    public function insertOrder($request)
    {
        $order = [];
        foreach ($request->modality as $i => $v) {
            // to table orders
            $order = Order::insert([
                'invoice_id' => $this->invoice->id,
                'modality_id' => $request->modality[$i],
                'price' => str_replace(",", "", $request->price[$i]),
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
