<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['slug', 'name', 'mobile', 'role', 'email',  'user_id'];

    public function scopeSelectCustomer()
    {
        return $this->with('hospitals')
            ->orderBy('name', 'asc')
            ->get();
    }

    public function gravatar($size = 150)
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim("$this->email"))) . "?d=mp&s=" . $size;
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
