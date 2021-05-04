<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PacsInstallation extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = [
        'slug',
        'hospital_id',
        'handover_date',
        'start_installation_date',
        'finish_installation_date',
        'training_date',
        'warranty_start',
        'warranty_end'
    ];

    // relationship
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function engineers()
    {
        return $this->hasMany(PacsEngineer::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
