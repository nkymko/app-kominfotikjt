<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lead',
        'member_sum',
        'slug'
    ];

    /**
     * Eager Loading
     *
     * @var array<int, string>
     */
    protected $with = [
        'user',
    ];

    public function profile()
    {
        return $this->hasMany(Profile::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'lead');
    }

}
