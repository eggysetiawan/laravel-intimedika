<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PacsEngineer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'engineerable_id',
        'engineerable_type',
        'pacs_installation_id',
        'user_id'
    ];

    public function engineerable()
    {
        return $this->morphTo();
    }

    // engineers.technician.name
    public function technician()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
