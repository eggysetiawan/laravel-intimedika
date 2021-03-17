<?php

namespace App\Services;

use App\Order;
use Illuminate\Support\Str;

class FunnelService
{
    private $offer, $invoice;

    public function createOffer($request)
    {
        $attr = $request->all();
        // insert into offer table
        $attr['customer_id'] = $request->customer;
        return $this->offer = auth()->user()->offers()->create($attr);
    }

    public function createInvoice()
    {
        return $this->invoice = $this->offer->invoices()->create();
    }

    public function createProgress($request)
    {
        return $this->offer->progress()->create([
            'progress' => $request->progress,
            'status' => 'Funnel',
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

    public function createFunnel($request)
    {
        $attr = $request->all();
        // assign to funnel slug
        $attr['slug'] = Str::slug($request->description . ' ' . date('YmdHis'));
        // insert into funnels table
        return $this->offer->funnel()->create($attr);
    }

    public function updateOrder($request, $funnel)
    {
        $insert = [];
        foreach ($funnel->offer->invoices->last()->orders as $i => $order) {
            // to table orders
            $insert =  $order->update([
                'modality_id' => $request->modality[$i],
                'price' => str_replace(",", "", $request->price[$i]),
                'references' => $request->references[$i],
                'updated_at' => now()->toDateTimeString(),
            ]);
        }
        return $insert;
    }
}
