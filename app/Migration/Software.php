<?php

namespace App\Migration;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'softwareversion';
}
