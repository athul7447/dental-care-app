<?php
namespace App\Repositories\Admin;

use App\Models\Admin;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminRepository
{
    public function updateProfile($id,$request)
    {
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if($request->password){
            $admin->password = Hash::make($request->password);
        }
        $admin->save();
        return true;
    }

    public function getAllDoctors()
    {
        return Doctor::all();
    }

    public function storeDoctor($request)
    {
        $doctor = new Doctor();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(Storage::disk('public')->path('doctors'),$imageName);
            $doctor->image = $imageName;
        }
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->password = Hash::make($request->password);
        $doctor->phone = $request->phone;
        $doctor->address = $request->address;
        $doctor->qualification = $request->qualification;
        $doctor->username = $request->username;
        $doctor->save();
        return true;
    }

    public function getDoctor($id)
    {
        return Doctor::findorfail($id);
    }

    public function updateDoctor($request,$id)
    {
        $doctor = Doctor::findOrFail($id);
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
        $doctor->email = $request->email;
        $doctor->phone = $request->phone;
        $doctor->address = $request->address;
        $doctor->qualification = $request->qualification;
        $doctor->username = $request->username;
        if($request->password){
            $doctor->password = Hash::make($request->password);
        }
        $doctor->save();
        return true;
    }

    public function deleteDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return true;
    }

    public function verifyDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->is_verified = 1;
        $doctor->save();
        return true;
    }

    public function changeDoctorStatus($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->is_active = !$doctor->is_active;
        $doctor->save();
        return true;
    }
}
