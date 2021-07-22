<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warranty extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'warrantyable_id',
        'warrantyable_type',
        'start',
        'end',
        'status'
    ];

    protected $dates = ['start', 'end'];

    // relations
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function warrantyable()
    {
        return $this->morphTo();
    }
}
