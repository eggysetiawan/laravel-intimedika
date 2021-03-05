<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funnel extends Model
{
    protected $fillable = ['slug', 'progress', 'date', 'description'];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
