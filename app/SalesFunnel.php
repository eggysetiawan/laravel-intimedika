<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesFunnel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'sales_funnel';
}
