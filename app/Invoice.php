<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = ['offer_id', 'status', 'date'];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
