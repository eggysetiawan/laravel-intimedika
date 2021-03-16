<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{

    protected $fillable = ['name', 'slug', 'phone', 'city', 'address', 'email', 'class', 'code', 'address'];

    public function scopeSelectHospitalLimit()
    {
        return $this->pluck(['id', 'name', 'city'])
            ->orderBy('name', 'asc')
            ->where('name', '!=', '')
            ->limit(1000)
            ->get();
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }
}
