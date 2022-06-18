<?php
namespace App\Repositories\portal;

use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class DoctorRepository
{
    public function register($request)
    {
        $doctor = Doctor::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'qualification' => $request->qualification,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);
        return true;
    }
}
