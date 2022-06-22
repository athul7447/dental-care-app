<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'name',
        'email',
        'phone',
        'date',
        'time',
        'note',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
