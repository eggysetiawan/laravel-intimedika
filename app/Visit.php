<?php

namespace App;

use App\Hospital;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['request', 'slug', 'result', 'customer_id', 'username'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'username');
    }
}
