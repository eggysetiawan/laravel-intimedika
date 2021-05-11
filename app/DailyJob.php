<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyJob extends Model
{
    use SoftDeletes;
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
