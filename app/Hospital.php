<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{

    protected $fillable = ['name', 'slug', 'phone', 'city', 'address', 'email', 'class', 'code', 'address'];

    public function scopeSelectHospital()
    {
        return $this->select(['id', 'name', 'city'])
            ->orderBy('name', 'asc')
            ->where('name', '!=', '')
            ->get();
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }
}
