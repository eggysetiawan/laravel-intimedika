<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CustomerHospital extends Pivot
{
    protected $incrementing = true;

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
