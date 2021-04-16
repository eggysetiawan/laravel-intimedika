<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    protected $fillable = [
        'need',
        'price',
        'day',
        'total',
        'note'
    ];

    public function advance()
    {
        return $this->belongsTo(Advance::class);
    }
}
