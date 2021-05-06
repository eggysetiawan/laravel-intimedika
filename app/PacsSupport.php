<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PacsSupport extends Model
{
    protected $fillable = [
        'slug',
        'pacs_installation_id',
        'hospital_personel',
        'report_date',
        'report_time',
        'problem',
        'problem_solve',
        'solve',
        'solve_date',
        'solve_time'
    ];



    // relationship

    public function engineers()
    {
        return $this->morphMany('App\PacsEngineer', 'engineerable');
    }

    public function installation()
    {
        return $this->belongsTo(PacsInstallation::class, 'pacs_installation_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
