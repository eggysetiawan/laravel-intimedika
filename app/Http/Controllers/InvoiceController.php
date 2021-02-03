<?php

namespace App\Http\Controllers;

use App\Offer;

class InvoiceController extends Controller
{
    public function show(Offer $offer)
    {
        return view('invoices.show', compact('offer'));
    }
    public function print(Offer $offer)
    {
        return view('invoices.print', compact('offer'));
    }
}
