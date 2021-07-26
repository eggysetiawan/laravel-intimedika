<?php

namespace App\Migration;

use Illuminate\Database\Eloquent\Model;

class Installation extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'teknik_instalasi';
}
