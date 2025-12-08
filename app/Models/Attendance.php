<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'work_date',
        'clock_in_at',
        'clock_out_at',
        'clock_in_ip',
        'clock_out_ip',
        'late_minutes'
    ];

    protected $dates = ['clock_in_at', 'clock_out_at', 'work_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isClockedIn()
    {
        return !is_null($this->clock_in_at);
    }

    public function isClockedOut()
    {
        return !is_null($this->clock_out_at);
    }

    public function getStatusAttribute()
    {
        if ($this->isClockedOut()) return 'completed';
        if ($this->isClockedIn()) return 'present';
        return 'absent';
    }
}
