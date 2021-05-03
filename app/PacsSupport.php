<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PacsSupport extends Model
{
    protected $guarded = [];

    // relationship

    public function pacsInstallation()
    {
        return $this->belongsTo(PacsInstallation::class, 'pacs_installation_id');
    }
}
