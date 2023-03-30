<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recap extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];

    /**
     * Eager Loading
     *
     * @var array<int, string>
     */
    protected $with = [
        'user', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
