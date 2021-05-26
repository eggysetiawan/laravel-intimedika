<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'sales_order';
}
