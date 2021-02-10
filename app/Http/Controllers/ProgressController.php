<?php

namespace App\Http\Controllers;

use App\Demo;
use App\Offer;
use App\OfferProgress;
use App\Http\Requests\OfferProgressRequest;
use App\Invoice;

class ProgressController extends Controller
{

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

                foreach ($orders as $order => $v) {
                    $order->update([
                        'price' => str_replace(".", "", $request->price[$order]),
                        'quantity' => str_replace(".", "", $request->qty[$order]),
                    ]);
                }


                $request->validate([
                    'img' => 'required_if:progress,99|mimes:png,jpg,jpeg',
                ]);
                $attr['shipping'] = str_replace(".", "", request('shipping'));
                $offer->progress->update($attr);
                $imgName = date('YmdHi') . '.' . request()->file('img')->extension();

                $offer->invoices->first()
                    ->addMediaFromRequest('img')
                    ->usingFileName($imgName)
                    ->toMediaCollection('image_po');




                // to taxes table
                // $price_po = $attr['price_po'];

                break;


            default:

                $offer->progress->update($attr);


        endswitch;

        session()->flash('success', 'Progress Penawaran berhasil di update!');

        return redirect('offers');
    }
}
