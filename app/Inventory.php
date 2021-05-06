<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'department_id',
        'service_tag',
        'serial_number',
        'item',
        'quantity',
        'user',
        'location',
        'purchase_date',
        'note',
        'type'
    ];

    // relationship
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
