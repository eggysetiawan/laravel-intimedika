<?php

namespace App\Services;

use App\Offer;
use App\Order;
use App\FirstOffer;
use App\FixPriceOrder;
use App\Events\OfferCreated;

class OfferService
{
    protected
        $invoice,
        $offer,
        $order;

    public function getDate($request)
    {
        return date('Y-m-d', strtotime($request->date));
    }

    public function maxOfferNo()
    {
        if (!Offer::first()) {
            return 'Belum ada penawaran dibuat.';
        }

        return Offer::where(function ($query) {
            $maxYear = $query->max('offer_date');
            return $query->where('offer_date', $maxYear);
        })
            ->max('offer_no');
    }

    public function createOffer($request)
    {
        $attr = $request->validated();

        // convert month romawi
        $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");

        // offer_no
        $queue = str_pad($request->queue, 3, '0', STR_PAD_LEFT);
        $initial = auth()->user()->initial;
        $bln = $array_bln[date('n', strtotime($request->date))];
        $tahun = date('Y', strtotime($request->date));

        $attr['offer_no'] = 'Q-' . $queue . '/IPI/' . $initial . '/' . $bln . '/' . $tahun;
        $attr['offer_no_unique'] =   $tahun . $request->queue;
        $attr['slug'] = 'Q-' . $queue . '-IPI-' . $initial . '-' . $bln . '-' . $tahun;
        $date = $this->getDate($request);
        $attr['offer_date'] = $date;
        $attr['customer_id'] = $request->customer;

        return $this->offer =  auth()->user()->offers()->create($attr);
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
        foreach ($request->modalities as $i => $v) {
            // to table orders
            $order = Order::insert([
                'invoice_id' => $this->invoice->id,
                'modality_id' => $request->modalities[$i],
                'price' => str_replace([",", "_"], "", $request->prices[$i]),
                'quantity' => $request->qty[$i],
                'references' => $request->references[$i],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]);

            // insert into first offer table

        }
        return $order;
    }

    public function insertFirstOffer()
    {
        $firstOffer = [];
        foreach ($this->invoice->orders as $order) {
            // to table orders
            $firstOffer = FirstOffer::insert([
                'offer_id' => $order->invoice->offer->id,
                'order_id' => $order->id,
                'price' => str_replace([",", "_"], "", $order->price),
                'quantity' => $order->quantity,
            ]);

            // insert into first offer table

        }
        return $firstOffer;
    }

    public function insertPrice($request)
    {
        $order = [];
        foreach ($request->modalities as $i => $v) {
            // to table orders
            $order = FixPriceOrder::insert([
                'offer_id' => $this->offer->id,
                'modality_id' => $request->modalities[$i],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]);
        }
        return $order;
    }

    public function updateOrder($offer, $request)
    {
        $order = [];
        foreach ($offer->invoices->first()->orders as $i => $order) {
            // to table orders
            $order = $order->update([
                'modality_id' => $request->modality[$i],
                'price' => str_replace([",", "_"], "", $request->price[$i]),
                'references' => $request->references[$i],
                'updated_at' => now()->toDateTimeString(),
            ]);
        }
        return $order;
    }

    public function updateFirstOffer($offer, $request)
    {
        $firstOffer = [];
        foreach ($offer->invoices->first()->orders as $i => $order) {
            $firstOffer = $order->first_offer->update([
                'price' => str_replace([",", "_"], "", $request->price[$i]),
                'quantity' => $request->qty[$i],
            ]);
        }
        return $firstOffer;
    }

    public function sendOfferEmailToDirector()
    {
        if ($this->offer->offer_no_unique > 2021105) {
            return event(new OfferCreated($this->offer));
        }
        return null;
    }

    public function directOffer()
    {
        if ($this->offer->offer_no_unique <= 2021105) {
            return  $this->offer->update([
                'is_approved' => 1,
                'approved_by' => $this->offer->approved_by,
                'approved_at' => now()
            ]);
        }
        return null;
    }
}
