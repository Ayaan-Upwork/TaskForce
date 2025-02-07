<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;
    protected $fillable = [
        'employe_name',
        'employe_email',
        'employe_number',
        'employe_address',
        'employe_status'
    ];

    public function roasters()
    {
        return $this->hasMany(Roaster::class, 'emp_id');
    }
}
