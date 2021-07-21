<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'installation_id',
        'start',
        'end',
        'description',
    ];

    protected $dates = [
        'start',
        'end'
    ];
}
