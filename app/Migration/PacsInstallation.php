<?php

namespace App\Migration;

use Illuminate\Database\Eloquent\Model;

class PacsInstallation extends Model
{
    protected $connection = 'mysql3';
    protected $table = 'pacs_installations';
}
