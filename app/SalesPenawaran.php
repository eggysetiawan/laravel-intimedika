<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesPenawaran extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'sales_penawaran';

    protected $primaryKey = 'pk_penawaran';

    public function sales_order()
    {
        return $this->hasMany(SalesOrder::class, 'fk_penawaran', 'pk_penawaran');
    }
}
