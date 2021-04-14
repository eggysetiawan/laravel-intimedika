<?php

namespace App\Http\Controllers;

use App\Offer;
use Barryvdh\DomPDF\Facade as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PdfController extends Controller
{
    public function offer(Offer $offer)
    {
        $data['offer'] = $offer->load(['invoices.orders.modality', 'author',  'customer', 'progress', 'invoices.orders']);
        $data['qrcode'] = base64_encode(QrCode::format('svg')->size(95)->errorCorrection('H')->generate(route('pdf.offer', $offer->slug)));
        $pdf = PDF::loadView('invoices.print', $data);
        $pdf->setPaper('a4', 'potrait');
        $pdf->setWarnings(false);
        return $pdf->stream($offer->offer_no . '_' . $offer->author->name . '.pdf');
    }
}
