<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modality extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'model',
        'brand',
        'price',
        'spec',
        'category',
        'reference',
        'stock'
    ];

    public function scopeSelectModality()
    {
        return $this->orderBy('name', 'asc')->get();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
