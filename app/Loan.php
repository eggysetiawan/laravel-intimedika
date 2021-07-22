<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PackageVersions\Installer;

class Loan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'installation_id',
        'start',
        'end',
        'description',
    ];

    protected $dates = [
        'start',
        'end'
    ];

    // relations
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function installation()
    {
        return $this->belongsTo(Installation::class);
    }
}
