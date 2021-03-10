<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $fillable = ['is_called', 'reason'];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
