<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demo extends Model
{
    protected $fillable = ['offer_progress_id', 'date', 'description'];

    public function progress()
    {
        return $this->belongsTo(OfferProgress::class, 'offer_progress_id');
    }
}
