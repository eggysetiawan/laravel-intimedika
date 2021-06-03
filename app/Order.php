<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_id',
        'modality_id',
        'quantity',
        'status',
        'price',
        'references'
    ];

    // relationship
    public function first_offer()
    {
        return $this->hasOne(FirstOffer::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
