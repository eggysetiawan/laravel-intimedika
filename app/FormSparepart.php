<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormSparepart extends Model
{
    protected $fillable = [
        'modality_id',
        'label'
    ];

    public $timestamps = false;

    // relations
    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }
}
