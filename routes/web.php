<?php

use Illuminate\Support\Facades\Route;

// Auth Controller
use App\Http\Controllers\Auth\LoginController as AuthLogin;


// Frontend Controller
use App\Http\Controllers\Frontend\ContactController as Contact;
use App\Http\Controllers\Frontend\AboutController as About;
use App\Http\Controllers\Frontend\HomeController as Home;
use App\Http\Controllers\Frontend\ServicesController as Services;
use App\Http\Controllers\Frontend\PriceController as Price;
use App\Http\Controllers\Frontend\ArticleController as Article;
// use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\Auth\ForgotPasswordController;
// use App\Http\Controllers\Auth\ResetPasswordController;
// use App\Http\Controllers\Auth\VerificationController;

// Admin Controller
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ContactController as AdminContact;
use App\Http\Controllers\Admin\ClientController as AdminClient;
use App\Http\Controllers\Admin\SettingsController as AdminSettings;
use App\Http\Controllers\Admin\SocialMediaController as AdminSocialMedia;



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

// Services
Route::get('/services', [Services::class, 'index'])->name('services');

// Price
Route::get('/price', [Price::class, 'index'])->name('price');

// Contacts
Route::get('/contact', [Contact::class, 'index'])->name('contact.index');
Route::post('/contact', [Contact::class,'store'])->name('contact.store');

// Article
Route::get('/article', [Article::class, 'index'])->name('article');


// Admin
Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');

    // Contact
    Route::get('/contact', [AdminContact::class, 'index'])->name('admin.contact');
    Route::delete('/contact', [AdminContact::class, 'destroy'])->name('admin.contact.destroy');

    // Client
    Route::get('/client', [AdminClient::class, 'index'])->name('admin.client');
    Route::post('/client', [AdminClient::class, 'store'])->name('admin.client.store');
    Route::delete('/client', [AdminClient::class, 'destroy'])->name('admin.client.destroy');

    // Settings
    Route::get('/settings', [AdminSettings::class, 'index'])->name('admin.settings');
    Route::put('/settings', [AdminSocialMedia::class, 'update'])->name('admin.social.update');
});

