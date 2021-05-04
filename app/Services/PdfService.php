<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade as PDF;
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

    public function exportAdvance($advance)
    {
        $data['advance'] = $advance->load(['hospitals', 'needs', 'author']);
        $data['ongoing_date'] = date('d-m-Y', strtotime($advance->start_date)) . ' - ' . date('d-m-Y', strtotime($advance->end_date));
        // $data['qrcode'] = base64_encode(QrCode::format('svg')->size(95)->errorCorrection('H')->generate(route('pdf.offer', $offer->slug)));
        $pdf = PDF::loadView('advances.print.print', $data);
        $pdf->setPaper('a4', 'potrait');
        $pdf->setWarnings(false);

        $destination = str_replace(" ", "_", $advance->destination);
        $date = date('Y_m_d', strtotime($advance->start_date));
        return $pdf->stream('Advance_' . $destination . '_' . $date . '.pdf');
    }

    public function exportPacsInstallation($pacsInstallation)
    {
        $data['pacsinstallation'] = $pacsInstallation;
        $pdf = PDF::loadview('pacs.insallation.partials.pdf', $data)->setPaper('A4', 'potrait');
        return $pdf->stream();
    }
}
