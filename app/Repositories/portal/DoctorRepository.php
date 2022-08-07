<?php
namespace App\Repositories\portal;

use App\Mail\ApproveMail;
use App\Mail\DeclineMail;
use App\Mail\RescheduleMail;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\PatientNote;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        $doctor->appointment_per_day = $request->appointment_per_day;
        $doctor->address = $request->address;
        if($request->password){
            $doctor->password = Hash::make($request->password);
        }
        $doctor->save();
        return true;
    }

    public function getMyAppointments($id)
    {
        $appointment=Appointment::where('doctor_id',$id)->orderBy('created_at','desc')->get();
        return $appointment;
    }

    public function approveAppointment($id,$doctor_id)
    {
        $appointment=Appointment::where('id',$id)->where('is_declined',0)->where('doctor_id',$doctor_id)->first();
        if($appointment){
            $appointment->status=1;
            $appointment->save();
            $doctor=Doctor::find($doctor_id);
            $mailData=[
                'name'=>$appointment->name,
                'date'=>$appointment->date,
                'time'=>$appointment->time,
                'doctor'=>$doctor->name,
            ];
            Mail::to($appointment->email)->send(new ApproveMail($mailData));
            return true;
        }
        return false;
    }

    public function getAppointments($id)
    {
        $appointment=Appointment::where('doctor_id',$id)->get();
        return $appointment;
    }

    public function declineAppointment($id,$doctor_id)
    {
        $appointment=Appointment::where('id',$id)->where('status',0)->where('doctor_id',$doctor_id)->first();
        if($appointment){
            $appointment->is_declined=1;
            $appointment->save();
            $mailData=[
                'name'=>$appointment->name,
            ];
            Mail::to($appointment->email)->send(new DeclineMail($mailData));
            return true;
        }
        return false;
    }

    public function getTodaysAppointmentCount($id)
    {
        $appointment=Appointment::where('doctor_id',$id)->where('date',date('Y-m-d'))->count();
        return $appointment;
    }

    public function getAllAppointmentsCount($id)
    {
        $appointment=Appointment::where('doctor_id',$id)->count();
        return $appointment;
    }

    public function getApprovedAppointmentsCount($id)
    {
        $appointment=Appointment::where('doctor_id',$id)->where('status',1)->count();
        return $appointment;
    }

    public function getDeclinedAppointmentsCount($id)
    {
        $appointment=Appointment::where('doctor_id',$id)->where('is_declined',1)->count();
        return $appointment;
    }

    public function getAppointment($id,$doctorId)
    {
        $appointment=Appointment::where('id',$id)->where('doctor_id',$doctorId)->first();
        return $appointment;
    }

    public function getDoctors()
    {
        $doctors=Doctor::where('is_active',1)->where('is_verified',1)->get();
        return $doctors;
    }

    public function updateAppointment($request,$id,$doctor)
    {
        $date=date('Y-m-d',strtotime($request->date));
        $doctorAppointment=Appointment::where('doctor_id',$doctor->id)
                            ->where('status',0)
                            ->where('is_declined',0)
                            ->where('date',$date)->count();
        if($doctorAppointment > $doctor->appointment_per_day){
            return false;
        }
        $appointment=Appointment::where('id',$id)->where('doctor_id',$doctor->id)->first();
        if($appointment){
            $appointment->date=$request->date;
            $appointment->time=$request->time;
            $appointment->status=1;
            $appointment->save();
            $mailData=[
                'name'=>$appointment->name,
                'date'=>$appointment->date,
                'time'=>$appointment->time,
                'doctor'=>$doctor->name,
            ];
            Mail::to($appointment->email)->send(new RescheduleMail($mailData));
            return true;
        }
        return false;
    }

    public function getPatientNotes($id)
    {
        $appointment= Appointment::where('doctor_id',$id)->where('is_note_added',1)->get();
        return $appointment;
    }

    public function storePatientNote($request,$id)
    {
        $appointment=Appointment::where('id',$request->appointment_id)->first();
        $note=PatientNote::where('appointment_id',$appointment->id)->first();
        if($appointment){
            if(empty($note)){
            $patientNote=PatientNote::create([
                'appointment_id'=>$request->appointment_id,
                'note'=>$request->note,
                'doctor_id'=>$id,
            ]);
            $appointment->is_note_added=1;
            $appointment->save();
            return true;
        }else{
            PatientNote::where('id',$note->id)->update([
                'appointment_id'=>$request->appointment_id,
                'note'=>$request->note,
                'doctor_id'=>$id,
            ]);
            return true;
        }
        }
        return false;
    }

    public function getNote($appointmentId,$doctorId)
    {
        $note=PatientNote::where('appointment_id',$appointmentId)->with('appointment')->where('doctor_id',$doctorId)->first();
        return $note;
    }

}
