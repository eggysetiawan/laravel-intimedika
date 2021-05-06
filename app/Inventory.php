<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'departmen_id',
        'service_tag',
        'serial_number',
        'item',
        'quantity',
        'user',
        'location',
        'purchase_date',
        'note'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
