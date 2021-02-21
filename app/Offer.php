<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Offer extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $fillable = ['customer_id',  'offer_no', 'budget', 'reference', 'offer_date', 'price_note',  'warranty_note', 'availability_note', 'payment_note', 'note', 'is_approved', 'approved_at', 'approved_by', 'offer_date', 'slug'];

    public function tax()
    {
        return $this->hasOne(Tax::class);
    }

    public function progress()
    {
        return $this->hasOne(OfferProgress::class);
    }

    public function progressApproval()
    {
        return $this->hasOne(OfferProgress::class)->where('progress', 99);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class)->latest();
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
