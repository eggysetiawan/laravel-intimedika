<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Advance;
use App\Services\PdfService;

class PdfController extends Controller
{
    public function offer(Offer $offer, PdfService $pdfService)
    {
        return $pdfService->exportOfferPage($offer);
    }

    public function advance(Advance $advance, PdfService $pdfService)
    {
        return $pdfService->exportAdvance($advance);
    }
}
