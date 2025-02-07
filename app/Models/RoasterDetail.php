<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoasterDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'roaster_id',
        'location_id',
        'daily_date',
        'start_time',
        'end_time',
        'description',
    ];
    public function locations()
    {
        return $this->belongsTo(Location::class,'location_id');
    }
}
