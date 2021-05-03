<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PacsEngineer extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function pacsInstallation()
    {
        return $this->belongsTo(PacsInstallation::class, 'pacs_installation_id');
    }
}
