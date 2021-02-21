<?php

namespace App\Http\Controllers;

use App\Tax;
use App\Demo;
use App\Offer;
use App\OfferProgress;
use App\DataTables\OfferDataTable;
use App\Http\Requests\OfferProgressRequest;

class ProgressController extends Controller
{

    public function approval(OfferDataTable $dataTable)
    {
        return $dataTable
            ->with([
                'approval_po' => true,
            ])
            ->render('offers.index', [
                'tableHeader' => 'Purchase Order is Ready to Approve',
                'approval' => OfferProgress::whereNull('is_approved')->count(),
            ]);
    }

    public function create(Offer $offer)
    {
        return view('progress.create', [
            'offer' => $offer,
        ]);
    }

    public function update(Offer $offer, OfferProgressRequest $request)
    {
        $attr = $request->all();

        switch ($request->progress):
            case (50):
                $offer->progress->update($attr);
                Demo::create([
                    'offer_progress_id' => $offer->progress->id,
                    'date' => date('Y-m-d', strtotime($request->demo_date)),
                    'description' => $request->description,
                ]);
                break;

            case (99):
                $orders = $offer->invoices->first()->orders
                    ->whereIn('id', $request->id_order);
                $price_po = 0;
                foreach ($orders as $i => $order) {
                    $order->update([
                        'price' => str_replace(".", "", $request->price[$i]),
                        'quantity' => $request->qty[$i],
                    ]);
                    $price_po += str_replace(".", "", $request->price[$i]) * $request->qty[$i];
                }

                $ppn = ($price_po * (10 / 100));

                Tax::create([
                    'invoice_id' => $offer->invoices->first()->id,
                    'price_po' => $price_po,
                    'dpp' => $price_po,
                    'ppn' => $ppn,
                    'nett' => $price_po,
                    'shipping' => str_replace(".", "", $request->shipping),
                ]);


                $offer->progress->update($attr);

                // insert image to media table
                $request->validate([
                    'img' => 'required_if:progress,99|mimes:png,jpg,jpeg',
                ]);
                $imgName = date('YmdHi') . '.' . request()->file('img')->extension();
                $offer->invoices->first()
                    ->addMediaFromRequest('img')
                    ->usingFileName($imgName)
                    ->toMediaCollection('image_po');
                break;


            default:

                $offer->progress->update($attr);


        endswitch;

        session()->flash('success', 'Progress Penawaran berhasil di update!');

        return redirect('offers');
    }
}
