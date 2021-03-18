<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixPriceOrder extends Model
{
    protected $fillable = ['modality_id', 'price'];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
    public function modality()
    {
        return  $this->belongsTo(Modality::class);
    }
}
