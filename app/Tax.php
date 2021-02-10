<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use SoftDeletes;

    protected $fillable = ['offer_id', 'dpp', 'pph', 'komisi', 'nett', 'shipping', 'bank_admin'];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
