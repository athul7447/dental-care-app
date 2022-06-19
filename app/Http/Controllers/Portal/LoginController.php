<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRegisterRequest;
use App\Repositories\portal\DoctorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct(DoctorRepository $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }
    public function login()
    {
        return view('portal.login');
    }
    public function loginSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::guard('portal')->attempt($credentials)) {
            return redirect()->route('portal.dashboard');
        }

        return redirect()->route('portal.login')->with('error', 'Invalid credentials');
    }

    public function register()
    {
        return view('portal.register');
    }

    public function registerSubmit(DoctorRegisterRequest $request)
    {
        try{
            $result=$this->doctorRepository->register($request);
            if($result){
                return redirect()->route('portal.login')->with('success','Registration Successful');
            }
        }catch(\Exception $e){
            return redirect()->route('portal.login')->with('error','Registration Failed');
        }

    }

    public function logout()
    {
        Auth::guard('portal')->logout();
        return redirect()->route('portal.login');
    }
}
