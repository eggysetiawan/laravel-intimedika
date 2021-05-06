<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PacsStakeholder extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'pacs_installation_id',
        'radiology_name',
        'radiographer_name',
        'phone_radiology',
        'email_radiology',
        'it_hospital_name',
        'phone_it',
        'email_it',
        'phone_radiographer',
        'email_radiographer',
        'user_note'
    ];

    // relationship
    public function installation()
    {
        return $this->belongsTo(PacsInstallation::class, 'pacs_installation_id');
    }
}
