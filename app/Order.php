<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = ['invoice_id', 'modality_id', 'quantity', 'status', 'price'];

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
