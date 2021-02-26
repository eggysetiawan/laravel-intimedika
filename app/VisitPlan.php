<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitPlan extends Model
{
    protected $fillable = ['date', 'description', 'is_visited', 'area', 'territory'];
    protected $table = 'visitplan';

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
}
