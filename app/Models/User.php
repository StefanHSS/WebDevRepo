<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'roles_users');
    }

    public function avatar()
    {
        return $this->hasOne('App\Models\Image');
    }

    public function hasRole($roleParam)
    {
        foreach($this->roles()->get() as $role)
        {
            if(Str::lower($role->name) == Str::lower($roleParam))
            {
                return true;
            }
        }
        return false;
    }
}
