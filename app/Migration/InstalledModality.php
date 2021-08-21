<?php

namespace App\Migration;

use Illuminate\Database\Eloquent\Model;

class InstalledModality extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'teknik_modality';
}
