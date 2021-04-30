<?php

namespace App;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Invoice extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = ['status', 'date', 'offer_id'];

    // business logic

    public function notPaid()
    {
        return $this->tax()->where('is_paid', 0)->exists();
    }

    public function notPaidLabel()
    {
        $not_paid = $this->tax()->where('is_paid', 0)->exists();

        if ($not_paid) {
            return 'Belum Lunas';
        }

        if (!$not_paid) {
            return 'Lunas';
        }
    }

    public function getTotalPurchaseAttribute()
    {
        return $this->tax->price_po + $this->tax->ppn + $this->tax->shipping;
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(800)
            ->height(600)
            ->performOnCollections('image_po');
    }

    // relationship
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
