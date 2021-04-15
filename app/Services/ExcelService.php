<?php

namespace App\Services;

use App\Offer;

class ExcelService
{
    public static function getOffers()
    {
        return Offer::with(['customer.hospitals', 'author', 'invoices.orders', 'progress.demo', 'invoices.tax'])
            ->when(!auth()->user()->isAdmin(), function ($query) { //jika bukan admin, tampilkan hanya penawaran milik masing2 sales.
                return $query->where('user_id', auth()->id());
            })
            ->when(request('from') && request('to'), function ($query) { //query untuk filter periode from ~ to.
                return $query->whereBetween('offer_date', [request('from'), request('to')]);
            })->whereHas('progress', function ($query) {
                return $query->where('progress', 100);
            })
            ->get();
    }
}
