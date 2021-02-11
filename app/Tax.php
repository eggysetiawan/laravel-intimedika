<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use SoftDeletes;

    protected $fillable = ['invoice_id', 'price_po', 'dpp', 'pph', 'komisi', 'nett', 'shipping', 'bank_admin', 'ppn'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
