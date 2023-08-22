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
use App\Http\Controllers\Frontend\GalleryController as Gallery;

// Admin Controller
use App\Http\Controllers\Admin\AboutController as AdminAbout;
use App\Http\Controllers\Admin\BannerController as AdminBanner;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CarController as AdminCar;
use App\Http\Controllers\Admin\ProfileController as AdminProfile;
use App\Http\Controllers\Admin\ArticleController as AdminArticle;
use App\Http\Controllers\Admin\CategoryCarsController as AdminCategoryCars;
use App\Http\Controllers\Admin\ContactController as AdminContact;
use App\Http\Controllers\Admin\GalleryController as AdminGallery;
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

// Gallery
Route::get('/gallery/photo', [Gallery::class, 'photo'])->name('gallery.photo');
Route::get('/gallery/video', [Gallery::class, 'video'])->name('gallery.video');

// Contacts
Route::get('/contact', [Contact::class, 'index'])->name('contact');
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

    Route::get('/profile', [AdminProfile::class, 'index'])->name('admin.profile');
    Route::PATCH('/profile', [AdminProfile::class, 'update'])->name('admin.profile.update');

    // Banner
    Route::get('/banner', [AdminBanner::class, 'index'])->name('admin.banner');
    Route::post('/banner', [AdminBanner::class, 'store'])->name('admin.banner.store');
    Route::delete('/banner', [AdminBanner::class, 'destroy'])->name('admin.banner.destroy');

    // Cars
    Route::get('/cars', [AdminCar::class, 'index'])->name('admin.cars');
    Route::get('/cars/edit/{id}', [AdminCar::class, 'edit'])->name('admin.car.edit');
    Route::get('/cars/create', [AdminCar::class, 'create'])->name('admin.car.create');
    Route::post('/car', [AdminCar::class, 'update'])->name('admin.car.update');
    Route::delete('/cars', [AdminCar::class, 'destroy'])->name('admin.car.destroy');
    Route::post('/cars', [AdminCar::class,'store'])->name('admin.car.store');

    // Categories
    Route::get('/category-cars', [AdminCategoryCars::class, 'index'])->name('admin.category_cars');
    Route::post('/category-cars', [AdminCategoryCars::class, 'store'])->name('admin.category_cars.store');
    Route::delete('/category-cars', [AdminCategoryCars::class, 'destroy'])->name('admin.category_cars.destroy');

    // Contact
    Route::get('/contact', [AdminContact::class, 'index'])->name('admin.contact');
    Route::delete('/contact', [AdminContact::class, 'destroy'])->name('admin.contact.destroy');

    // Client
    Route::get('/client', [AdminClient::class, 'index'])->name('admin.client');
    Route::post('/client', [AdminClient::class, 'store'])->name('admin.client.store');
    Route::delete('/client', [AdminClient::class, 'destroy'])->name('admin.client.destroy');

    // Article
    Route::get('/article', [AdminArticle::class, 'index'])->name('admin.article');
    Route::get('/article/create', [AdminArticle::class, 'create'])->name('admin.article.create');
    Route::get('/article/edit/{slug}', [AdminArticle::class, 'edit'])->name('admin.article.edit');
    Route::post('/article', [AdminArticle::class, 'store'])->name('admin.article.store');
    Route::post('/articlee', [AdminArticle::class, 'update'])->name('admin.article.update');
    Route::delete('/article', [AdminArticle::class, 'destroy'])->name('admin.article.destroy');

    // Category
    Route::get('/category', [AdminCategory::class, 'index'])->name('admin.category');
    Route::post('/category', [AdminCategory::class,'store'])->name('admin.category.store');
    Route::delete('/category', [AdminCategory::class, 'destroy'])->name('admin.category.destroy');

    // About
    Route::get('/about', [AdminAbout::class, 'index'])->name('admin.about');
    Route::post('/about', [AdminAbout::class, 'update'])->name('admin.about.update');

    // Gallery
    Route::get('/gallery', [AdminGallery::class, 'index'])->name('admin.gallery');
    Route::post('/gallery', [AdminGallery::class, 'store'])->name('admin.gallery.store');
    Route::delete('/gallery', [AdminGallery::class, 'destroy'])->name('admin.gallery.destroy');

    // Settings
    Route::get('/settings', [AdminSettings::class, 'index'])->name('admin.settings');
    Route::patch('/settings', [AdminSettings::class, 'update'])->name('admin.setting.update');
    Route::post('/settings', [AdminSettings::class, 'update'])->name('admin.setting.post');
});

