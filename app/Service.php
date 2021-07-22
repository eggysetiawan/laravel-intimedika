<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements HasMedia
{
    use InteractsWithMedia;
    use SoftDeletes;

    protected $dates = ['date'];

    protected $fillable = [
        'installation_id',
        'modality_id',
        'customer_id',
        'software_id',
        'sn',
        'date',
        'condition',
        'problem',
        'service_note',
        'result',
        'sales_id',
        'status',
        'is_finished',
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

    public function installation()
    {
        return $this->belongsTo(Installation::class);
    }

    // polymorphism relationship
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
