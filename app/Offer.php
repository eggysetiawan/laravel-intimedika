<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use SoftDeletes;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
