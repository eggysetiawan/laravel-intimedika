<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PacsInstallation extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    // relationship
    public function engineers()
    {
        return $this->hasMany(PacsEngineer::class);
    }
}
