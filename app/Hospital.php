<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'phone',
        'city',
        'address',
        'email',
        'class',
        'code',
        'address'
    ];

    public function scopeSelectHospitalLimit()
    {
        return $this->select(['id', 'name', 'city'])
            ->orderBy('name', 'asc')
            ->where('name', '!=', '')
            ->limit(1000)
            ->get();
    }
    public static function selectHospital()
    {
        return static::select(['id', 'name', 'city'])
            ->orderBy('name', 'asc')
            ->where('name', '!=', '')
            ->limit(5)
            ->get();
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }

    public function advances()
    {
        return $this->belongsToMany(Advance::class);
    }
}
