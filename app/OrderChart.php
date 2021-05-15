<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderChart extends Model
{
    protected $guarded = [];

    // relationship

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
