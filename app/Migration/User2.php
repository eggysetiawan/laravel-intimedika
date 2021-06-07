<?php

namespace App\Migration;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User2 extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $connection = 'mysql3';
    protected $table = 'users';
}
