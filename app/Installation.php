<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Installation extends Model implements HasMedia
{
    use InteractsWithMedia;
    use SoftDeletes;

    protected $dates = ['dates'];

    protected $fillable = [
        'modality_id',
        'customer_id',
        'software_id',
        'sn',
        'date',
        'is_installed',
        'is_tested',
        'is_trained',
        'note',
        'pre_installation_note',
        'reference',
    ];

    // relations
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    // polymorphysm relationship
    public function logs()
    {
        return $this->morphMany('App\Log', 'logable');
    }

    public function worktimes()
    {
        return $this->morphMany('App\Worktime', 'worktimeable');
    }

    public function activities()
    {
        return $this->morphMany('App\Activity', 'activityable');
    }

    public function warranties()
    {
        return $this->morphMany('App\Warranty', 'warrantyable');
    }
}
