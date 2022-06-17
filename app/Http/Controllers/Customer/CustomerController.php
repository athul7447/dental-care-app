<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
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

    public function contact()
    {
        return view('customer.contact');
    }
}
