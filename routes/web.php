<?php

use Illuminate\Support\Facades\Route;

// Auth Controller
use App\Http\Controllers\Auth\LoginController as AuthLogin;
use App\Http\Controllers\Frontend\ContactController as Contact;
use App\Http\Controllers\Frontend\AboutController as About;
use App\Http\Controllers\Frontend\HomeController as Home;
// use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\Auth\ForgotPasswordController;
// use App\Http\Controllers\Auth\ResetPasswordController;
// use App\Http\Controllers\Auth\VerificationController;

// Admin Controller
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ContactController as AdminContact;
use App\Http\Controllers\Admin\SettingsController as AdminSettings;



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

// Authentication
Route::get('/login', [AuthLogin::class, 'index'])->name('login');
Route::post('/login', [AuthLogin::class, 'store'])->name('login.store');
Route::get('/logout', [AuthLogin::class, 'destroy'])->name('logout');

// Home
Route::get('/', [Home::class, 'index'])->name('home');

// About
Route::get('/about', [About::class, 'index'])->name('about');

// Contacts
Route::get('/contact', [Contact::class, 'index'])->name('contact.index');
Route::post('/contact', [Contact::class,'store'])->name('contact.store');


// Admin
Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');

    // Contact
    Route::get('/contact', [AdminContact::class, 'index'])->name('admin.contact');
    Route::delete('/contact', [AdminContact::class, 'destroy'])->name('admin.contact.destroy');

    // Settings
    Route::get('/settings', [AdminSettings::class, 'index'])->name('admin.settings');
});

