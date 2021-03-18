<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixPriceOrder extends Model
{
    protected $fillable = ['modality_id', 'price', 'offer_id', 'order_id'];



    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }
}
