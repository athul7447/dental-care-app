<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[\App\Http\Controllers\Customer\CustomerController::class,'index'])->name('customer.index');
Route::get('/about-us.html',[\App\Http\Controllers\Customer\CustomerController::class,'about'])->name('customer.about');
Route::get('/news.html',[\App\Http\Controllers\Customer\CustomerController::class,'news'])->name('customer.news');
Route::get('/services.html',[\App\Http\Controllers\Customer\CustomerController::class,'services'])->name('customer.services');
Route::get('/appointment.html',[\App\Http\Controllers\Customer\CustomerController::class,'appointment'])->name('customer.appointment');
Route::post('/submit-appointment.html',[\App\Http\Controllers\Customer\CustomerController::class,'submitAppointment'])->name('customer.submit-appointment');

Route::prefix('admin')->group(function () {
    Route::get('', [\App\Http\Controllers\Auth\LoginController::class,'showLoginForm'])->name('login');
    Route::post('login/submit',[\App\Http\Controllers\Auth\LoginController::class,'login'])->name('login.submit');
    Route::post('logout', [\App\Http\Controllers\Admin\AdminController::class,'logout'])->name('logout');
    Route::name('admin.')->group(function () {
        Route::get('/dashboard',[\App\Http\Controllers\Admin\AdminController::class,'dashboard'])->name('dashboard');
        Route::get('/profile',[\App\Http\Controllers\Admin\AdminController::class,'profile'])->name('profile');
        Route::post('/profile/update',[\App\Http\Controllers\Admin\AdminController::class,'updateProfile'])->name('profile.update');

        //portal maanagement
        Route::get('/doctors',[\App\Http\Controllers\Admin\AdminController::class,'getAllDoctors'])->name('portal.doctors');
        Route::get('/doctors/create',[\App\Http\Controllers\Admin\AdminController::class,'createDoctor'])->name('portal.doctors.create');
        Route::post('/doctors/create',[\App\Http\Controllers\Admin\AdminController::class,'storeDoctor'])->name('portal.doctors.store');
        Route::get('/doctors/{id}/edit',[\App\Http\Controllers\Admin\AdminController::class,'editDoctor'])->name('portal.doctors.edit');
        Route::post('/doctors/{id}/edit',[\App\Http\Controllers\Admin\AdminController::class,'updateDoctor'])->name('portal.doctors.update');
        Route::get('/doctors/{id}/delete',[\App\Http\Controllers\Admin\AdminController::class,'deleteDoctor'])->name('portal.doctors.delete');
        Route::get('doctors/{id}/verify',[\App\Http\Controllers\Admin\AdminController::class,'verifyDoctor'])->name('portal.doctors.verify');
        Route::get('doctors/{id}/status',[\App\Http\Controllers\Admin\AdminController::class,'changeDoctorStatus'])->name('portal.doctors.status');
        Route::get('/doctors/{id}/appointments',[\App\Http\Controllers\Admin\AdminController::class,'getAppointments'])->name('portal.doctors.appointments');
        Route::get('/doctors/{doctor_id}/appointments/{appointment_id}/approve',[\App\Http\Controllers\Admin\AdminController::class,'approveAppointment'])->name('portal.doctors.appointments.approve');
        Route::get('/doctors/{doctor_id}/appointments/{appointment_id}/delete',[\App\Http\Controllers\Admin\AdminController::class,'deleteAppointment'])->name('portal.doctors.appointments.delete');
        Route::get('/doctors/{doctor_id}/appointments/{appointment_id}/edit',[\App\Http\Controllers\Admin\AdminController::class,'editAppointment'])->name('portal.doctors.appointments.edit');
        Route::post('/doctors/{doctor_id}/appointments/{appointment_id}/update',[\App\Http\Controllers\Admin\AdminController::class,'updateAppointment'])->name('portal.doctors.appointments.update');
        Route::get('/doctors/{doctor_id}/appointments/{appointment_id}/decline',[\App\Http\Controllers\Admin\AdminController::class,'declineAppointment'])->name('portal.doctors.appointments.decline');
        Route::get('/doctors/{doctor_id}/calendar',[\App\Http\Controllers\Admin\AdminController::class,'appointmentCalendar'])->name('portal.doctors.calendar');
    });
});

Route::prefix('portal')->name('portal.')->group(function () {
    Route::get('/login',[\App\Http\Controllers\Portal\LoginController::class,'login'])->name('login');
    Route::post('/login/submit',[\App\Http\Controllers\Portal\LoginController::class,'loginSubmit'])->name('login.submit');
    Route::get('/register',[\App\Http\Controllers\Portal\LoginController::class,'register'])->name('register');
    Route::post('/register/submit',[\App\Http\Controllers\Portal\LoginController::class,'registerSubmit'])->name('register.submit');
    Route::post('/logout',[\App\Http\Controllers\Portal\LoginController::class,'logout'])->name('logout');
    Route::get('/dashboard',[\App\Http\Controllers\Doctor\DoctorContoller::class,'dashboard'])->name('dashboard');
    Route::get('/profile',[\App\Http\Controllers\Doctor\DoctorContoller::class,'myProfile'])->name('profile');
    Route::post('/profile/update',[\App\Http\Controllers\Doctor\DoctorContoller::class,'updateProfile'])->name('profile.update');
    Route::get('/appointments',[\App\Http\Controllers\Doctor\DoctorContoller::class,'appointments'])->name('appointments');
    Route::get('/appointments/{id}/approve',[\App\Http\Controllers\Doctor\DoctorContoller::class,'approveAppointment'])->name('appointments.approve');
    Route::get('/appointments/{id}/decline',[\App\Http\Controllers\Doctor\DoctorContoller::class,'declineAppointment'])->name('appointments.decline');
    Route::get('/appointments/{id}/reschedule',[\App\Http\Controllers\Doctor\DoctorContoller::class,'rescheduleAppointment'])->name('appointments.reschedule');
    Route::post('/appointments/{id}/reschedule',[\App\Http\Controllers\Doctor\DoctorContoller::class,'updaterescheduleAppointment'])->name('appointments.reschedule.update');
    Route::get('/appointments-calendar',[\App\Http\Controllers\Doctor\DoctorContoller::class,'appointmentsCalendar'])->name('appointments.calendar');
});
