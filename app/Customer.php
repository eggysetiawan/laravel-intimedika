<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['slug', 'name', 'mobile', 'role', 'email', 'hospital_id', 'user_id'];

    public function gravatar($size = 150)
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim("$this->email"))) . "?d=mp&s=" . $size;
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
