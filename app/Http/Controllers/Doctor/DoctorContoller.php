<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorContoller extends Controller
{
    public function __construct()
    {

    }

    public function dashboard()
    {
        return view('portal.dashboard');
    }


}
