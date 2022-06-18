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
Route::get('/contact.html',[\App\Http\Controllers\Customer\CustomerController::class,'contact'])->name('customer.contact');

Route::prefix('admin')->group(function () {
    Route::get('', [\App\Http\Controllers\Auth\LoginController::class,'showLoginForm'])->name('login');
    Route::post('login/submit',[\App\Http\Controllers\Auth\LoginController::class,'login'])->name('login.submit');
    Route::post('logout', [\App\Http\Controllers\Admin\AdminController::class,'logout'])->name('logout');
    Route::name('admin.')->group(function () {
        Route::get('/dashboard',[\App\Http\Controllers\Admin\AdminController::class,'dashboard'])->name('dashboard');
        Route::get('/profile',[\App\Http\Controllers\Admin\AdminController::class,'profile'])->name('profile');
        Route::post('/profile/update',[\App\Http\Controllers\Admin\AdminController::class,'updateProfile'])->name('profile.update');
    });
});
