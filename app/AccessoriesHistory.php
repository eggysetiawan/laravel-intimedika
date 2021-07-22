<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessoriesHistory extends Model
{
    protected $fillable = [
        'modality_id',
        'accessories',
        'quantity',
        'io_history',
        'source'
    ];

    // relations
    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
