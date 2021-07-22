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
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }
}
