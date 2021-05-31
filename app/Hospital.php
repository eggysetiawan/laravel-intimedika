<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'phone',
        'city',
        'address',
        'email',
        'class',
        'code',
        'address'
    ];

    public static function intiwidHospital()
    {
        return static::whereHas('pacs')->groupBy('id')->get();
    }

    public static function hospitalBlade()
    {
        return static::select(['id', 'name', 'city'])
            ->orderBy('name', 'asc')
            ->where('name', '!=', '')
            ->get();
    }
    public static function selectHospital()
    {
        return static::select(['id', 'name', 'city'])
            ->orderBy('name', 'asc')
            ->where('name', '!=', '')
            ->limit(5)
            ->get();
    }

    // relationship
    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }


    public function advances()
    {
        return $this->belongsToMany(Advance::class);
    }

    public function pacs()
    {
        return $this->hasMany(PacsInstallation::class);
    }
}
