<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['slug', 'name', 'mobile', 'role', 'email',  'user_id', 'person_in_charge'];

    public static function selectCustomer()
    {
        return static::with('hospitals')
            ->when(!auth()->user()->isAdmin(), function ($query) {
                return $query->where('user_id', auth()->id());
            })
            ->orderBy('name', 'asc')
            ->limit(5)
            ->get();
    }

    public static function selectAllCustomer($search)
    {
        return static::with('hospitals')
            ->orderBy('name', 'asc')
            ->where('name', 'LIKE', '%' . $search . '%')
            ->when(!auth()->user()->isAdmin(), function ($query) {
                return $query->where('user_id', auth()->id());
            })
            ->orWhere(function ($query) use ($search) {
                return $query->whereHas('hospitals', function ($q) use ($search) {
                    return $q->where('name', 'LIKE', '%' . $search . '%');
                });
            })
            ->limit(20)
            ->get();
    }

    public function gravatar($size = 150)
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim("$this->email"))) . "?d=mp&s=" . $size;
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class);
    }


    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
