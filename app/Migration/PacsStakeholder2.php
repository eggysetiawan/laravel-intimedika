<?php

namespace App\Migration;

use Illuminate\Database\Eloquent\Model;

class PacsStakeholder2 extends Model
{
    protected $connection = 'mysql3';
    protected $table = 'pacs_stakeholders';
}
