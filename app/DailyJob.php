<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyJob extends Model
{
    protected $dates = ['date'];
    protected $fillable = [
        'title',
        'slug',
        'description',
        'date'
    ];
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
