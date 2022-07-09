<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRegisterRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Repositories\portal\DoctorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorContoller extends Controller
{
    private $doctorRepository;
    public function __construct(DoctorRepository $doctorRepository) {
        $this->middleware('auth:portal');
        $this->doctorRepository = $doctorRepository;
    }

    public function dashboard()
    {
        $todaysAppointmentCount = $this->doctorRepository->getTodaysAppointmentCount(Auth::id());
        $allAppointmentsCount = $this->doctorRepository->getAllAppointmentsCount(Auth::id());
        $approvedAppointmentsCount = $this->doctorRepository->getApprovedAppointmentsCount(Auth::id());
        $declinedAppointmentsCount = $this->doctorRepository->getDeclinedAppointmentsCount(Auth::id());
        return view('portal.dashboard',compact(
            'todaysAppointmentCount',
            'allAppointmentsCount',
            'approvedAppointmentsCount',
            'declinedAppointmentsCount'
        ));
    }

    public function myProfile()
    {
        return view('portal.doctor-profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'image' => 'bail|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'name' => 'bail|required|max:255|string',
            'username' => 'bail|required|max:255|string|unique:doctors,username,'.Auth::guard('portal')->user()->id,
            'email' => 'bail|required|email|max:255|unique:doctors,email,'.Auth::guard('portal')->user()->id,
            'qualification' => 'bail|required|max:255|string',
            'phone' => 'bail|required|max:255|string',
            'address' => 'bail|required|max:500|string',
            'appointment_per_day' => 'bail|required|max:50|numeric',
            'password' => 'bail|nullable|min:6|confirmed',
        ]);
        try{
            $result=$this->doctorRepository->updateDoctor($request,Auth::guard('portal')->user()->id);
            if($result){
                return redirect()->route('portal.profile')->with('success','Profile Updated Successfully');
            }
        }catch(\Exception $e){
            return redirect()->route('portal.profile')->with('error','Profile Update Failed');
        }
    }

    public function appointmentsCalendar()
    {
        $appointments=$this->doctorRepository->getAppointments(Auth::guard('portal')->user()->id);
        return view('portal.booking',compact('appointments'));
    }

    public function appointments()
    {
        $appointments=$this->doctorRepository->getMyAppointments(Auth::id());
        return view('portal.appointments',compact('appointments'));
    }

    public  function approveAppointment($id)
    {
        try{
            $result=$this->doctorRepository->approveAppointment($id,Auth::id());
            if($result){
                return redirect()->route('portal.appointments')->with('success','Appointment Approved Successfully');
            }else{
                return redirect()->route('portal.appointments')->with('error','Appointment Approval Failed');
            }
        }catch(\Exception $e){
            return redirect()->route('portal.appointments')->with('error','Appointment Approval Failed');
        }
    }

    public function declineAppointment($id)
    {
        try{
            $result=$this->doctorRepository->declineAppointment($id,Auth::id());
            if($result){
                return redirect()->route('portal.appointments')->with('success','Appointment Declined Successfully');
            }else{
                return redirect()->route('portal.appointments')->with('error','Appointment Decline Failed');
            }
        }catch(\Exception $e){
            return redirect()->route('portal.appointments')->with('error','Appointment Decline Failed');
        }
    }

    public function rescheduleAppointment($id)
    {
        $appointment=$this->doctorRepository->getAppointment($id,Auth::id());
        $doctors=$this->doctorRepository->getDoctors();
        if($appointment){
            return view('portal.reshedule-appointment',compact('appointment','doctors'));
        }else{
            return redirect()->route('portal.appointments')->with('error','Appointment Not Found');
        }
    }

    public function updateRescheduleAppointment(Request $request,$id)
    {
        $request->validate([
            'date' => 'bail|required|date',
            'time' => 'bail|required',
        ]);
        try{
            $result=$this->doctorRepository->updateAppointment($request,$id,Auth::user());
            if($result){
                return redirect()->route('portal.appointments')->with('success','Appointment Reshedule Successfully');
            }else{
                return redirect()->route('portal.appointments.reshedule',$id)->with('error','Your appointment limit is reached');
            }
        }catch(\Exception $e){
            return redirect()->route('portal.appointments.reshedule',$id)->with('error','Appointment Reshedule Failed');
        }
    }

}
