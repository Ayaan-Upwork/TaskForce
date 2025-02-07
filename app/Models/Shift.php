<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $fillable = [
        'shift_name',
        'start_time',
        'end_time'
    ];

    public function getStartTimeAttribute($time)
    {
       return  date('h:i a', strtotime($time));
    }

    public function getEndTimeAttribute($time)
    {
        return  date('h:i a', strtotime($time));
    }
    // public function getStartTime(){}
}

