<?php

namespace App\Services;

use App\Offer;
use Carbon\Carbon;

class FilterService
{
    public function getFromDate()
    {
        $offer = Offer::firstDate();
        return Carbon::parse($offer->offer_date)->format('Y-m-d');
    }
}
