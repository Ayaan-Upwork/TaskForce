<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Locale;

class Roaster extends Model
{
    use HasFactory;

    protected $table = 'roasters';
    protected $fillable = [
        'emp_id',
        'from_date',
        'to_date',
        'description',
    ];

    public function employees()
    {
        return $this->belongsTo(Employe::class, 'emp_id');
    }
    public function details()
    {
        return $this->hasMany(RoasterDetail::class, 'roaster_id');
    }
    public function shifts()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }
    public function locations()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
