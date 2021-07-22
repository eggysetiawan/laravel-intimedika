<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worktime extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'worktimeable_id',
        'worktimeable_type',
        'log_id',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'overtime',
        'description'
    ];

    protected $dates = ['start_date', 'start_time', 'end_date', 'end_time'];

    // relations
    public function log()
    {
        return $this->belongsTo(Log::class);
    }

    // polymorphism relationship
    public function worktimeable()
    {
        return $this->morphTo();
    }
}
