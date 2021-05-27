<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesTarget extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'sales_targeting';
    protected $foreignKey = 'funnel_fk';
    protected $primaryKey = 'pk';


    public function sales_funnel()
    {
        return $this->belongsTo(SalesFunnel::class, 'funnel_fk', 'pk',);
    }
}
