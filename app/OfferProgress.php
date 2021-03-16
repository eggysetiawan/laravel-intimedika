<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferProgress extends Model
{
    use SoftDeletes;

    protected $fillable = ['progress', 'detail', 'status', 'progress_date', 'is_approved', 'approved_at', 'approved_by'];
    protected $table = 'offer_progress';


    public function scopeReadyToApprove()
    {
        return $this->whereNull('is_approved')
            ->where('progress', 99)
            ->count();
    }

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
