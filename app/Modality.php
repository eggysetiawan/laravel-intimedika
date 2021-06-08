<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Modality extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'name',
        'slug',
        'model',
        'brand',
        'price',
        'spec',
        'category',
        'reference',
        'stock',
        'unit'
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
