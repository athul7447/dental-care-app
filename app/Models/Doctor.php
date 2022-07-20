<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Authenticatable
{
    use HasFactory,SoftDeletes;
    protected $guard = 'doctor';
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'qualification',
        'username',
        'appointment_per_day',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function isActive()
    {
        return $this->is_active;
    }

    public function isVerified()
    {
        return $this->is_verified;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class)->orderBy('created_at','desc');;
    }
}
