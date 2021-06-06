<?php

namespace App\Migration;

use Illuminate\Database\Eloquent\Model;

class User2 extends Model
{
    protected $connection = 'mysql3';
    protected $table = 'users';
}
