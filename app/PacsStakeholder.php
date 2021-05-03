<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PacsStakeholder extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    // relationship
    public function pacsInstallation()
    {
        return $this->belongsTo(PacsInstallation::class, 'pacs_installation_id');
        # code...
    }
}
