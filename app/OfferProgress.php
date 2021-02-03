<?php

namespace App;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferProgress extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $table = 'offer_progress';
}
