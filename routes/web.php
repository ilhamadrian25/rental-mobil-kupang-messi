<?php

use Illuminate\Support\Facades\Route;

// Auth Controller
use App\Http\Controllers\Auth\LoginController as AuthLogin;
// use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\Auth\ForgotPasswordController;
// use App\Http\Controllers\Auth\ResetPasswordController;
// use App\Http\Controllers\Auth\VerificationController;

// Admin Controller
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ContactController as AdminContact;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication
Route::get('/login', [AuthLogin::class, 'index'])->name('login');
Route::post('/login', [AuthLogin::class, 'store'])->name('login.store');
Route::get('/logout', [AuthLogin::class, 'destroy'])->name('logout');


// Admin
Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');

    // Contact
    Route::get('/contact', [AdminContact::class, 'index'])->name('admin.contact');
});

