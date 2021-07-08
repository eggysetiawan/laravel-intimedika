<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $fillable = [
        'modality_id',
        'name',
        'quantity',
        'sn',
        'sn_history'
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
