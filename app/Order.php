<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = ['offer_id', 'modality_id', 'total', 'quantity', 'status'];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
