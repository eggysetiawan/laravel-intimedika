<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitPlan extends Model
{
    protected $fillable = ['date', 'description'];
    protected $table = 'visitplan';

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
}
