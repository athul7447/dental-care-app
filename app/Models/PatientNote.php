<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientNote extends Model
{
    use HasFactory;
    protected $fillable = [
        'appointment_id',
        'note',
        'doctor_id',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
