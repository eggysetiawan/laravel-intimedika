<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accessories extends Model
{
    protected $fillable = [
        'modality_id',
        'name',
        'part_number',
        'quantity',
        'sn'
    ];

    // relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }
}
