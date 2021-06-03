<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirstOffer extends Model
{
    protected $fillable = ['offer_id', 'order_id', 'quantity', 'price'];

    public $timestamps = false;

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
