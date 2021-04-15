<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advance extends Model
{
    use SoftDeletes;

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class);
    }
}
