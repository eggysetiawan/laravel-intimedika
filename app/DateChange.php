<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DateChange extends Model
{
    protected $fillable = [
        'changeable_id',
        'changeable_type'
    ];

    // relations
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // polymorphysm relationship
    public function changeable()
    {
        return $this->morphTo();
    }
}
