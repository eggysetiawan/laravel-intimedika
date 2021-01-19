<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['id', 'slug', 'name', 'mobile', 'role', 'email', 'username', 'hospital_id'];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
