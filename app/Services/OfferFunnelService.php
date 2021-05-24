<?php

namespace App\Services;

use App\Order;
use App\FixPriceOrder;

class OfferFunnelService
{

    public function getDate($request)
    {
        return date('Y-m-d', strtotime($request->date));
    }

    public function updateOffer($offer, $request)
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
        $attr['slug'] = 'Q-' . $queue . '-IPI-' . $initial . '-' . $bln . '-' . $tahun;
        $date = $this->getDate($request);
        $attr['offer_date'] = $date;
        $attr['customer_id'] = $request->customer;

        return $offer->update($attr);
    }

    public function updateInvoice($offer, $request)
    {
        return $offer->invoices()->update([
            'date' => $this->getDate($request),
        ]);
    }

    public function updateProgress($offer, $request)
    {
        return $offer->progress()->update([
            'progress' => 30,
            'progress_date' => $this->getDate($request),
            'status' => 'On Progress',
        ]);
    }

    public function updateOrder($offer, $request)
    {
        $order = [];
        foreach ($request->modality as $i => $v) {
            // to table orders
            $order = Order::insert([
                'invoice_id' => $offer->invoices->first()->id,
                'modality_id' => $request->modality[$i],
                'price' => str_replace([",", "_"], "", $request->price[$i]),
                'references' => $request->references[$i],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]);
        }
        return $order;
    }

    public function insertService($offer, $request)
    {
        $order = [];
        foreach ($request->modality as $i => $v) {
            // to table orders
            $order = FixPriceOrder::insert([
                'offer_id' => $offer->id,
                'modality_id' => $request->modality[$i],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]);
        }
        return $order;
    }

    public function updateProgressFunnel($funnel)
    {
        return $funnel->update([
            'progress' => 100,
        ]);
    }
}
