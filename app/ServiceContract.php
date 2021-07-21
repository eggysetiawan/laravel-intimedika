<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceContract extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'service_id',
        'start',
        'end',
    ];

    protected $dates = ['start', 'end'];

    // relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
