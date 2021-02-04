<?php

namespace App;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferProgress extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $fillable = ['offer_id', 'progress', 'price_po', 'detail', 'status', 'progress_date', 'approval'];
    protected $table = 'offer_progress';

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
