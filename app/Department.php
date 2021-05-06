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


    // relations
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}
