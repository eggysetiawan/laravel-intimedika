<?php

namespace App\Migration;

use Illuminate\Database\Eloquent\Model;

class Hospital2 extends Model
{
    protected $connection = 'mysql3';
    protected $table = 'hospitals';
}
