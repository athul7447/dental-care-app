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
        if (Auth::attempt($credentials)) {
            return redirect()->intended('portal/dashboard')
                        ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
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
                $arr = array('msg' => 'Contact Added Successfully!', 'status' => true);
                return Response()->json($arr);
            }
        }catch(\Exception $e){
            $arr = array('msg' => 'Something went wrong. Please try again!', 'status' => false);
            return Response()->json($arr);
        }

    }
}
