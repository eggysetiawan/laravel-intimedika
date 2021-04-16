<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advance extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'objective',
        'title',
        'start_date',
        'end_date',
        'approved_by_supervisor_at',
        'approved_by_director_at'
    ];

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class);
    }
    public function needs()
    {
        return $this->hasMany(Need::class);
    }
}
