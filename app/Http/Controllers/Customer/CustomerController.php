<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Mail\AppointmentMail;
use App\Mail\ThankyouMail;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.index');
    }

    public function about()
    {
        return view('customer.about-us');
    }

    public function news()
    {
        return view('customer.news');
    }

    public function services()
    {
        return view('customer.services');
    }

    public function appointment()
    {
        $doctors = Doctor::where('is_active', 1)->where('is_verified', 1)->get();
        return view('customer.appointment',compact('doctors'));
    }

    public function submitAppointment(AppointmentRequest $request)
    {
        $appointment =Appointment::where('doctor_id',$request->doctor_name)->where('date',$request->date)->where('time',$request->time)->first();
        if($appointment){
            return response()->json(['status'=>'error','message'=>'Please select another time slot']);
        }
        if(strpos($request['email'], '@gmail.com') == false){
            return response()->json(['status'=>'error','message'=>'Please enter valid Email']);
        }
        try{
            $doctorId = $request->doctor_name;
            $doctor = Doctor::findOrFail($doctorId);
            $date=date('Y-m-d',strtotime($request->date));
            $doctorAppointment=Appointment::where('doctor_id',$doctorId)->where('date',$date)->count();
            if($doctorAppointment > $doctor->appointment_per_day){
                return response()->json(['status'=>'error','message'=>'Appointment limit reached for this doctor']);
            }
            $appointment=new Appointment();
            $appointment->name=$request->name;
            $appointment->email=$request->email;
            $appointment->phone=$request->phone;
            $appointment->date=date('Y-m-d',strtotime($request->date));
            $appointment->time=$request->time;
            $appointment->doctor_id=$request->doctor_name;
            $appointment->note=$request->note;
            $appointment->save();
            Mail::to($doctor->email)->send(new AppointmentMail($appointment));
            $mailData=['name'=>$appointment->name];
            Mail::to($request->email)->send(new ThankyouMail($mailData));
            return response()->json(['success'=>'Appointment Successfully Submitted']);
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }

    }
}
