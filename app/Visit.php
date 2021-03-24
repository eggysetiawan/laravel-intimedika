<?php

namespace App;

use App\User;
use App\VisitComment;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Visit extends Model implements HasMedia
{

    use InteractsWithMedia, SoftDeletes;

    protected $fillable = ['request', 'slug', 'result', 'customer_id', 'is_visited'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(800)
            ->height(600)
            ->performOnCollections('images');
    }

    public function plan()
    {
        return $this->hasOne(VisitPlan::class);
    }


    public static function last()
    {
        return static::all()->last();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(VisitComment::class);
    }

    public function getTakeImageAttribute()
    {
        return "/storage/" . $this->image;
    }
}
