<?php

namespace App;

use App\User;
use App\VisitComment;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['request', 'slug', 'result', 'customer_id', 'image'];

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
