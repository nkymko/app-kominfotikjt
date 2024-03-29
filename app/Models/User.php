<?php

namespace App\Models;

use App\Models\Profile;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'profile_id',
        'name',
        'email',
        'password', 
        'is_admin'
    ];

    // /**
    //  * Eager Loading
    //  *
    //  * @var array<int, string>
    //  */
    // protected $with = [
    //     'profile', 
    //     'absen',
    //     'recap'
    // ];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function absen()
    {
        return $this->hasMany(Absen::class, 'name', 'name');
    }

    public function recap()
    {
        return $this->hasMany(Recap::class);
    }

    // public function absen()
    // {
    //     return $this->hasMany(Absen::class, 'user_uuid', 'uuid');
    // }

    public function division()
    {
        return $this->hasOne(Division::class, 'lead', 'id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
