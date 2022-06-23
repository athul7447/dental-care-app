<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileRequest;
use App\Http\Requests\AppointmentRequest;
use App\Http\Requests\DoctorRegisterRequest;
use App\Http\Requests\DoctorUpdateRequest;
use Illuminate\Http\Request;
use App\Repositories\Admin\AdminRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    private $adminRepository;
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $allAppointmentsCount = $this->adminRepository->getAllAppointmentsCount();
        $allDoctorsCount = $this->adminRepository->getAllDoctorsCount();
        $todaysAppointmentCount = $this->adminRepository->getTodaysAppointmentCount();
        $totalDeclinedAppointmentCount = $this->adminRepository->getTotalDeclinedAppointmentCount();
        return view('admin.dashboard',compact(
            'allAppointmentsCount',
            'allDoctorsCount',
            'todaysAppointmentCount',
            'totalDeclinedAppointmentCount'
        ));
    }

    public function profile()
    {
        return view('admin.profile');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/admin');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

     /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    public function updateProfile(AdminProfileRequest $request)
    {
        try {
            $this->adminRepository->updateProfile(Auth::id(),$request);
            return redirect()->back()->with('message', 'Profile updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    public function getAlldoctors()
    {
        try {
            $doctors = $this->adminRepository->getAllDoctors();
            return view('admin.portal.doctors-list',compact('doctors'));
        }catch (\Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }
    public function createDoctor()
    {
        return view('admin.portal.create-doctor');
    }
    public function storeDoctor(DoctorRegisterRequest $request)
    {
        try {
            $this->adminRepository->storeDoctor($request);
            return redirect()->route('admin.portal.doctors')->with('message', 'Doctor created successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.portal.doctors')->with('message', $e->getMessage());
        }
    }

    public function editDoctor($id)
    {
        try {
            $doctor = $this->adminRepository->getDoctor($id);
            return view('admin.portal.edit-doctor',compact('doctor'));
        } catch (\Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    public function updateDoctor(DoctorUpdateRequest $request,$id)
    {
        try {
            $this->adminRepository->updateDoctor($request,$id);
            return redirect()->route('admin.portal.doctors')->with('message', 'Doctor updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.portal.doctors')->with('error', $e->getMessage());
        }
    }

    public function deleteDoctor($id)
    {
        try {
            $this->adminRepository->deleteDoctor($id);
            return redirect()->route('admin.portal.doctors')->with('message', 'Doctor deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.portal.doctors')->with('error', $e->getMessage());
        }
    }

    public function verifyDoctor($id)
    {
        try {
            $this->adminRepository->verifyDoctor($id);
            return redirect()->route('admin.portal.doctors')->with('message', 'Doctor verified successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.portal.doctors')->with('error', $e->getMessage());
        }
    }

    public function changeDoctorStatus($id)
    {
        try {
            $this->adminRepository->changeDoctorStatus($id);
            return redirect()->route('admin.portal.doctors')->with('message', 'Doctor status changed successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.portal.doctors')->with('error', $e->getMessage());
        }
    }

    public function getAppointments($id)
    {
        try {
            $appointments = $this->adminRepository->getAppointments($id);
            $doctorId = $id;
            if($appointments->count() > 0){
                return view('admin.portal.appointments-list',compact('appointments','doctorId'));
            }else{
                return redirect()->route('admin.portal.doctors')->with('message', 'No appointments found');
            }
        }catch (\Exception $e) {
            return redirect()->route('admin.portal.doctors')->with('error','No appointments found');
        }
    }

    public function approveAppointment($doctorId,$id)
    {
        try {
           $result= $this->adminRepository->approveAppointment($doctorId,$id);
            if($result){
                return redirect()->route('admin.portal.doctors.appointments',$doctorId)->with('message', 'Appointment approve status successfully');
            }else{
                return redirect()->route('admin.portal.doctors.appointments',$doctorId)->with('error', 'Something wrong happened!');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.portal.doctors.appointments',$doctorId)->with('error', 'Something wrong happened!');
        }
    }

    public function deleteAppointment($doctorId,$id)
    {
        try {
           $result= $this->adminRepository->deleteAppointment($doctorId,$id);
            if($result){
                return redirect()->route('admin.portal.doctors.appointments',$doctorId)->with('message', 'Appointment deleted successfully');
            }else{
                return redirect()->route('admin.portal.doctors.appointments',$doctorId)->with('error', 'Something wrong happened!');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.portal.doctors.appointments',$doctorId)->with('error', 'Something wrong happened!');
        }
    }

    public function editAppointment($doctorId,$id)
    {
        try {
            $appointment = $this->adminRepository->getAppointment($doctorId,$id);
            $doctors= $this->adminRepository->getDoctors();
            if($appointment){
                return view('admin.portal.edit-appointment',compact('appointment','doctorId','doctors'));
            }else{
                return redirect()->route('admin.portal.doctors.appointments',$doctorId)->with('error', 'No appointments found');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.portal.doctors.appointments',$doctorId)->with('error', 'No appointments found');
        }
    }

    public function updateAppointment(AppointmentRequest $request,$doctorId,$id)
    {
        try {
            if($this->adminRepository->updateAppointment($request,$doctorId,$id))
            {
                return redirect()->route('admin.portal.doctors')->with('message', 'Appointment updated successfully');
            }else{
                return redirect()->route('admin.portal.doctors')->with('error', 'Something wrong happened!');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.portal.doctors')->with('error', 'Something wrong happened!');
        }
    }

    public function declineAppointment($doctorId,$id)
    {
        try {
            $result= $this->adminRepository->declineAppointment($doctorId,$id);
            if($result){
                return redirect()->route('admin.portal.doctors.appointments',$doctorId)->with('message', 'Appointment decline status changed successfully ');
            }else{
                return redirect()->route('admin.portal.doctors.appointments',$doctorId)->with('error', 'Something wrong happened!');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.portal.doctors.appointments',$doctorId)->with('error', 'Something wrong happened!');
        }
    }

    public function appointmentCalendar($doctorId)
    {
        try {
            $appointments = $this->adminRepository->getDoctorAppointments($doctorId);
            $doctorId = $doctorId;
            if($appointments->count() > 0){
                return view('admin.portal.appointment-calendar',compact('appointments','doctorId'));
            }else{
                return redirect()->route('admin.portal.doctors')->with('error', 'No appointments found');
            }
        }catch (\Exception $e) {
            return redirect()->route('admin.portal.doctors')->with('error','No appointments found');
        }
    }

}
