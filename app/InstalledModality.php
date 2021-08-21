<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstalledModality extends Model
{
    protected $fillable = [
        'modalityable_id',
        'modalityable_type',
        'modality_id',
        'name'
    ];

    // relations
    public function modalityable()
    {
        return $this->morphTo();
    }

    public function installations()
    {
        return $this->belongsTo(Installation::class);
    }
}
