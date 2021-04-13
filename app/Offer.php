<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Offer extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Notifiable;

    protected $fillable = [
        'customer_id',
        'offer_no',
        'budget',
        'reference',
        'offer_date',
        'price_note',
        'warranty_note',
        'availability_note',
        'payment_note',
        'note',
        'is_approved',
        'approved_at',
        'approved_by',
        'offer_date',
        'slug'
    ];


    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $otp = $this->two_factor_code = rand(1000, 9999);
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();

        return $otp;
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function fixPrices()
    {
        return $this->hasMany(FixPriceOrder::class);
    }

    public function scopeFirstDateComplete()
    {

        return $this->whereHas('progress', function ($query) {
            return $query->where('progress', 100);
        })->orderBy('offer_date', 'asc')
            ->whereNotNull('offer_date')
            ->first();
    }
    public function scopeFirstDate()
    {
        return $this->orderBy('offer_date', 'asc')->whereNotNull('offer_date')->first();
    }

    public static function readytoPurchaseCount()
    {
        return static::whereHas('progressApproval')->count();
    }

    public static function readyToApproveCount()
    {
        return static::whereNull('is_approved')->whereNotNull('offer_no')->count();
    }

    public function revision()
    {
        return $this->hasOne(Revision::class);
    }

    public function funnel()
    {
        return $this->hasOne(Funnel::class);
    }

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

    public function repeats()
    {
        return $this->hasMany(Invoice::class)->whereHas('orders', function ($query) {
            return $query->whereNotNull('quantitiy');
        })
            ->latest();
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
