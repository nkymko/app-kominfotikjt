<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absen extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'name');
    }

    // Convert 
    // $clock_in = explode(':', $row['clock_in']);
    // $clock_out = explode(':', $row['clock_out']);
    // $time_in = ['hour' => intval($clock_in[0]), 'minute' => intval($clock_in[1])];
    // $time_out = ['hour' => intval($clock_out[0]), 'minute' => intval($clock_out[1])];
}
