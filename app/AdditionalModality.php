<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalModality extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'additionable_id',
        'additionable_type',
        'modality_id',
        'user_id',
        'sn'
    ];
}
