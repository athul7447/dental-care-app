<?php
namespace App\Repositories\portal;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function updateDoctor($request, $id)
    {
        $doctor = Doctor::find($id);
        if($request->hasFile('image')){
            if($doctor->image){
                Storage::disk('public')->delete('doctors/'.$doctor->image);
            }
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(Storage::disk('public')->path('doctors'),$imageName);
            $doctor->image = $imageName;
        }
        $doctor->name = $request->name;
        $doctor->username = $request->username;
        $doctor->email = $request->email;
        $doctor->qualification = $request->qualification;
        $doctor->phone = $request->phone;
        $doctor->address = $request->address;
        if($request->password){
            $doctor->password = Hash::make($request->password);
        }
        $doctor->save();
        return true;
    }

    public function getMyAppointments($id)
    {
        $appointment=Appointment::where('doctor_id',$id)->get();
        return $appointment;
    }

    public function approveAppointment($id,$doctor_id)
    {
        $appointment=Appointment::where('id',$id)->where('doctor_id',$doctor_id)->first();
        if($appointment){
            $appointment->status=1;
            $appointment->save();
            return true;
        }
        return false;
    }

    public function getAppointments($id)
    {
        $appointment=Appointment::where('doctor_id',$id)->get();
        return $appointment;
    }

}
