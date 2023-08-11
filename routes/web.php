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
use App\Http\Controllers\Frontend\CarController as Car;
// use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\Auth\ForgotPasswordController;
// use App\Http\Controllers\Auth\ResetPasswordController;
// use App\Http\Controllers\Auth\VerificationController;

// Admin Controller
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CarController as AdminCar;
use App\Http\Controllers\Admin\CategoryCarsController as AdminCategoryCars;
use App\Http\Controllers\Admin\ContactController as AdminContact;
use App\Http\Controllers\Admin\ClientController as AdminClient;
use App\Http\Controllers\Admin\SettingsController as AdminSettings;
use App\Http\Controllers\Admin\SocialMediaController as AdminSocialMedia;
use App\Http\Controllers\Admin\CategoryController as AdminCategory;



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

// Prices
Route::get('/price', [Price::class, 'index'])->name('price');

// Contacts
Route::get('/contact', [Contact::class, 'index'])->name('contact.index');
Route::post('/contact', [Contact::class,'store'])->name('contact.store');

// Cars
Route::get('/cars', [Car::class, 'index'])->name('cars');
Route::get('/car/{slug}', [Car::class, 'show'])->name('cars.show');

// Articles
Route::get('/article', [Article::class, 'index'])->name('article');
Route::get('/article/{slug}', [Article::class, 'show'])->name('article.show');

// Admin
Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');

    // Cars
    Route::get('/cars', [AdminCar::class, 'index'])->name('admin.cars');

    // Categories
    Route::get('/category-cars', [AdminCategoryCars::class, 'index'])->name('admin.category_cars');
    Route::post('/category-cars', [AdminCategoryCars::class, 'store'])->name('admin.category_cars.store');

    // Contact
    Route::get('/contact', [AdminContact::class, 'index'])->name('admin.contact');
    Route::delete('/contact', [AdminContact::class, 'destroy'])->name('admin.contact.destroy');

    // Client
    Route::get('/client', [AdminClient::class, 'index'])->name('admin.client');
    Route::post('/client', [AdminClient::class, 'store'])->name('admin.client.store');
    Route::delete('/client', [AdminClient::class, 'destroy'])->name('admin.client.destroy');

    // Category
    Route::get('/category', [AdminCategory::class, 'index'])->name('admin.category');
    Route::post('/category', [AdminCategory::class,'store'])->name('admin.category.store');
    Route::delete('/category', [AdminCategory::class, 'destroy'])->name('admin.category.destroy');

    // Settings
    Route::get('/settings', [AdminSettings::class, 'index'])->name('admin.settings');
    Route::put('/settings', [AdminSocialMedia::class, 'update'])->name('admin.social.update');
});

