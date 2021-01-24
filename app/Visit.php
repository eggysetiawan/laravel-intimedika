<?php

namespace App;

use App\User;
use App\VisitComment;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Visit extends Model implements HasMedia
{

    use InteractsWithMedia;

    protected $fillable = ['request', 'slug', 'result', 'customer_id'];

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
