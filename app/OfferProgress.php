<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferProgress extends Model
{
    use SoftDeletes;

    protected $fillable = ['offer_id', 'progress', 'price_po', 'detail', 'status', 'progress_date', 'approval', 'approved_at', 'approved_by'];
    protected $table = 'offer_progress';

    public function demo()
    {
        return $this->hasOne(Demo::class)->withDefault([
            'date' => '',
            'description' => '',
        ]);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
