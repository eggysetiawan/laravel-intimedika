<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{

    protected $fillable = [
        'name',
        'modality_id'
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
