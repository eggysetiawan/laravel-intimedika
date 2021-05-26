<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesTarget extends Model
{
    protected $connection = 'myslq2';
    protected $table = 'sales_targeting';
}
