<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'sales_order';
    protected $primaryKey = 'pk_order';


    public function sales_funnel()
    {
        return $this->belongsTo(SalesFunnel::class, 'funnel_fk', 'pk',);
    }

    public function sales_penawaran()
    {
        return $this->belongsTo(SalesPenawaran::class, 'fk_penawaran', 'pk_penawaran');
    }
}
