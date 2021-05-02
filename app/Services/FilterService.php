<?php

namespace App\Services;

use App\Offer;
use Carbon\Carbon;

class FilterService
{
    public function getOfferFromDate()
    {
        $offer = Offer::whereNotNull('offer_date')->orderBy('offer_date', 'ASC')->first();
        return (@$offer->offer_date) ?
            Carbon::parse($offer->offer_date)->format('Y-m-d') :
            date('Y-m-d');
    }
}
