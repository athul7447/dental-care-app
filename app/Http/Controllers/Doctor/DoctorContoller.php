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
        return view('portal.dashboard');
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
        return view('portal.booking');
    }

    public function appointments()
    {
        $appointments=$this->doctorRepository->getMyAppointments(Auth::id());
        return view('portal.appointments',compact('appointments'));
    }

}
