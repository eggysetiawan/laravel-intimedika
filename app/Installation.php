<?php

namespace App;

use App\Traits\TechnicianActivity;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Installation extends Model implements HasMedia
{
    use InteractsWithMedia;
    use SoftDeletes;
    use TechnicianActivity;

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

    public function installed_modalities()
    {
        return $this->belongsToMany(InstalledModality::class);
    }

    public function softwares()
    {
        return $this->belongsToMany(Software::class);
    }

    public function sales()
    {
        return $this->belongsTo(User::class, 'sales_id');
    }
}
