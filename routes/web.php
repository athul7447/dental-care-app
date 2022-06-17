<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
