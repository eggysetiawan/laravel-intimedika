<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'manager',
        'floor',
        'location'
    ];

    public static function getDepartmentId()
    {
        return static::where('name', auth()->user()->position)->first()->id;
    }

    // relations
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}
