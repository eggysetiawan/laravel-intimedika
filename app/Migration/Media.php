<?php

namespace App\Migration;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $connection = 'mysql3';
    protected $table = 'media';
}
