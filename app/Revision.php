<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $fillable = [
        'is_called',
        'reason',
        'revision_by'
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'revision_by');
    }
}
