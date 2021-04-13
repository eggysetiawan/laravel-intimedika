<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $fillable = [
        'slug',
        'year',
        'target'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
