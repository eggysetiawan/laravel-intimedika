<?php

namespace App\Migration;

use Illuminate\Database\Eloquent\Model;

class PacsStakeholder extends Model
{
    protected $connection = 'mysql3';

    public function installation()
    {
        return $this->belongsTo(PacsInstallation::class);
    }
}
