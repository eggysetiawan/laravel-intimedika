<?php

namespace App;

use App\Traits\TechnicianActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements HasMedia
{
    use InteractsWithMedia;
    use SoftDeletes;
    use TechnicianActivity;

    protected $dates = ['date'];

    protected $fillable = [
        'customer_id',
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

    public function installations()
    {
        return $this->belongsToMany(Installation::class);
    }

    public function sales()
    {
        return $this->belongsTo(User::class, 'sales_id');
    }

    public function installed_mods()
    {
        return $this->belongsToMany(InstalledModality::class);
    }

    public function softwares()
    {
        return $this->belongsToMany(Software::class);
    }
}
