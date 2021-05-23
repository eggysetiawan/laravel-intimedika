<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesCustomer extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'sales_customer';
}
