<?php

namespace App\Services;

use App\Offer;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Schema;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PdfService
{


    public function exportOfferPage($offer)
    {
        $data['offer'] = $offer->load(['invoices.orders.modality', 'author',  'customer', 'progress', 'invoices.orders']);
        $data['qrcode'] = base64_encode(QrCode::format('svg')->size(95)->errorCorrection('H')->generate(route('pdf.offer', $offer->slug)));
        $pdf = PDF::loadView('invoices.print', $data);
        $pdf->setPaper('a4', 'potrait');
        $pdf->setWarnings(false);
        return $pdf->stream($offer->offer_no . '_' . $offer->author->name . '.pdf');
    }

    public function exportOfferTable()
    {
        $offers = Offer::with(['customer.hospitals', 'author', 'invoices.orders', 'progress.demo', 'invoices.tax'])
            ->when(!auth()->user()->isAdmin(), function ($query) { //jika bukan admin, tampilkan hanya penawaran milik masing2 sales.
                return $query->where('user_id', auth()->id());
            })
            ->when(request('from') && request('to'), function ($query) { //query untuk filter periode from ~ to.
                return $query->whereBetween('offer_date', [request('from'), request('to')]);
            })->whereHas('progress', function ($query) {
                return $query->where('progress', 100);
            })
            ->get();

        // $orders = $offers->invoices->last()->orders;
        // $references = array();
        // foreach ($orders as $order) :
        //     $references[] = $order->references;
        // endforeach;
        // $references =  join(" & ", array_unique($references));

        $data['offers'] = $offers;
        // $data['references'] = $references;

        $pdf = PDF::loadView('exports.pdf.offer', $data);
        $pdf->setPaper('a4', 'landscape');
        $pdf->setWarnings(false);

        return $pdf->stream('IPI_Penawaran_' . uniqid() . '.pdf');
        // return view('exports.pdf.offer', compact('offers'));
    }
}
