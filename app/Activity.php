<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'hospital_has_activities';

    protected $fillable = [
        'customer_id',
        'activityable_id',
        'activityable_type',
        'name_user',
        'mobile_user',
    ];

    // relations
    public function activityable()
    {
        return $this->morphTo();
    }
}
