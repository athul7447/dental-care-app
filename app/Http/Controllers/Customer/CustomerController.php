<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

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
        try{
            $appointment=new Appointment();
            $appointment->name=$request->name;
            $appointment->email=$request->email;
            $appointment->phone=$request->phone;
            $appointment->date=date('Y-m-d',strtotime($request->date));
            $appointment->time=$request->time;
            $appointment->doctor_id=$request->doctor_name;
            $appointment->note=$request->note;
            $appointment->save();
            return redirect()->route('customer.appointment')->with('success','Appointment has been submitted successfully');
        }catch(\Exception $e){
            return redirect()->route('customer.appointment')->with('error','Something went wrong. Please try again later');
        }

    }
}
