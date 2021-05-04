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
        'position',
        'email',
        'password',
        'username',
        'phone',
        'pin',
        'last_login_time',
        'last_login_ip',
        'two_factor_code',
        'two_factor_expires_at'
    ];

    protected $dates = ['two_factor_expires_at'];

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

    public static function getRole($role)
    {
        return  static::with('roles')->role($role)->get();
    }

    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $otp = $this->two_factor_code = rand(1000, 9999);
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();

        return $otp;
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function gravatar($size = 150)
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($this->email))) . "?d=mp&s=" . $size;
    }

    // relations

    public function pacs_installs()
    {
        return $this->hasMany(PacsInstallation::class);
    }

    public function charts()
    {
        return $this->hasMany(OrderChart::class);
    }

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

    public function advances()
    {
        return $this->hasMany(Advance::class);
    }


    // roles

    public function isAdmin()
    {
        return $this->hasPermissionTo('approval');
    }

    public function superAdmin()
    {
        return $this->hasPermissionTo('openworld');
    }

    public function director()
    {
        return $this->hasRole('director');
    }

    public static function emailToDirector()
    {
        return static::where('username', 'intiwid01')->first();
    }
}
