<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesFunnel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'sales_funnel';
    protected $dates = ['start_funnel'];
    protected $primaryKey = 'pk';

    public function sales_targeting()
    {
        return $this->hasOne(SalesTarget::class, 'funnel_fk', 'pk');
    }

    public function sales_order()
    {
        return $this->hasMany(SalesOrder::class, 'penawaran_fk', 'pk_penawaran');
    }
}
