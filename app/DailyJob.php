<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DailyJob extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    protected $dates = ['date'];
    protected $fillable = [
        'slug',
        'description',
        'date'
    ];
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
