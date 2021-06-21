<?php

namespace App;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PacsInstallation extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;


    protected $dates = [
        'training_date',
        'handover_date',
        'start_installation_date',
        'finish_installation_date',
        'warranty_start',
        'warranty_end'
    ];

    protected $fillable = [
        'slug',
        'hospital_id',
        'handover_date',
        'start_installation_date',
        'finish_installation_date',
        'training_date',
        'warranty_start',
        'warranty_end',
        'anydesk_server',
        'anydesk_workstation'
    ];

    public static function selectInstallation($search)
    {
        return static::whereHas('hospital', function ($query) use ($search) {
            return $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('city', 'LIKE', '%' . $search . '%');
        })->get();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(800)
            ->height(600)
            ->performOnCollections('files');
    }

    public static function hospitalRequest($request)
    {
        return static::query()
            ->whereHas('hospital')
            ->where('id', $request->pacs_installation)
            ->first()
            ->hospital
            ->name;
    }

    // relationship
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function engineers()
    {
        return $this->morphMany('App\PacsEngineer', 'engineerable');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
    public function stakeholder()
    {
        return $this->hasOne(PacsStakeholder::class);
    }

    public function supports()
    {
        return $this->hasMany(PacsSupport::class);
    }
}
