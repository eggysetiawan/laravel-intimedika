<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class VisitComment extends Model
{
    protected $table = 'visitcomments';

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
