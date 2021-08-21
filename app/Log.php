<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'logable_id',
        'logable_type',
        'logue',
        'progress',
    ];

    // relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logable()
    {
        return $this->morphTo();
    }
}
