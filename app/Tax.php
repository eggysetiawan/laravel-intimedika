<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'offer_id',
        'invoice_id',
        'price_po',
        'dpp',
        'pph',
        'komisi',
        'komisi_percentage',
        'nett',
        'shipping',
        'bank_admin',
        'ppn',
        'cn',
        'cn_percentage'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
