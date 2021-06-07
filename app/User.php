<?php

namespace App;

use App\VisitComment;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasRoles;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'initial',
        'position',
        'email',
        'password',
        'city',
        'address',
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

    public static function salesChart()
    {
        return static::query()
            ->where('position', 'sales')
            ->whereHas('charts')
            ->get();
    }

    public  function theAuthor($model)
    {
        return auth()->id() === $model->user_id;
    }

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


    public function gravatar($size = 150)
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($this->email))) . "?d=mp&s=" . $size;
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(180)
            ->height(180)
            ->performOnCollections('profile');
    }

    // relations

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function daily_jobs()
    {
        return $this->hasMany(DailyJob::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function pacs_supports()
    {
        return $this->hasMany(PacsSupport::class);
    }


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

    public function pacs_engineers()
    {
        return $this->hasMany(PacsEngineer::class);
    }


    // roles

    public function isAdmin()
    {
        return $this->hasPermissionTo('approval') || $this->hasPermissionTo('supervise');
    }

    public function superAdmin()
    {
        return $this->hasPermissionTo('openworld');
    }

    public function supervisor()
    {
        return $this->hasPermissionTo('openworld') || $this->hasPermissionTo('supervise');
    }

    public function director()
    {
        return $this->hasRole('director');
    }

    public static function emailToDirector()
    {
        return static::where('username', 'intimedika01')->first();
    }
}
