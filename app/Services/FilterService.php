<?php

namespace App\Services;

use App\Offer;
use Carbon\Carbon;

class FilterService
{
    public function getOfferFromDate()
    {
        $offer = Offer::oldest();
        $date =  ($offer->firstDate()) ?
            Carbon::parse($offer->offer_date)->format('Y-m-d') :
            date('Y-m-d');

        return $date;
    }
}
