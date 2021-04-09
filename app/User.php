<?php

namespace App;

use App\VisitComment;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'level',
        'phone',
        'pin',
        'last_login_time',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pin'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function gravatar($size = 150)
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($this->email))) . "?d=mp&s=" . $size;
    }

    // relations

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function comments()
    {
        return $this->hasMany(VisitComment::class, 'id');
    }

    public function targets()
    {
        return $this->hasMany(Target::class);
    }


    // roles

    public function isAdmin()
    {
        return $this->level == "top" || $this->id == 13;
    }

    public function superAdmin()
    {
        return $this->level == 'top';
    }

    public function director()
    {
        return $this->where('id', 13)->first()->name;
    }

    public static function emailToDirector()
    {
        return static::where('username', 'intiwid01')->first();
    }
}
