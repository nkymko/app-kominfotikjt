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

    public function profile()
    {
        return $this->hasMany(Profile::class);
    }

    public function lead()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
