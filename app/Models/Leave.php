<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $table = 'leaves';
    protected $fillable = [
        'employe_id',
        'start_date',
        'end_date',
        'total_leave_days',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(Employe::class,'employe_id');
    }
}
