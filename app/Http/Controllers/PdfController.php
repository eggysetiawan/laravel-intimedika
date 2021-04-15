<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Services\PdfService;

class PdfController extends Controller
{
    public function offer(Offer $offer, PdfService $pdfService)
    {
        return $pdfService->exportOfferPage($offer);
    }
}
