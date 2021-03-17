<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Invoice extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $fillable = ['status', 'date', 'offer_id'];



    public function tax()
    {
        return $this->hasOne(Tax::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
