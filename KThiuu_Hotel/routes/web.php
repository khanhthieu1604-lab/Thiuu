<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VNPayController;
use App\Http\Controllers\SsoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| KThiuu Hotel - Web Routes
|--------------------------------------------------------------------------
*/

// SSO Routes - Thiuu Ecosystem
Route::prefix('sso')->name('sso.')->group(function () {
    Route::get('/callback', [SsoController::class, 'callback'])->name('callback');
    Route::get('/to-car-rental', [SsoController::class, 'redirectToCarRental'])->name('to-car-rental')->middleware('auth');
    Route::get('/portal', [SsoController::class, 'portal'])->name('portal');
});

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/contact', fn() => view('contact'))->name('contact');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create/{room}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::patch('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

    // VNPay Payment Routes
    Route::get('/payment/vnpay/return', [VNPayController::class, 'return'])->name('vnpay.return');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('hotels', App\Http\Controllers\Admin\HotelController::class);
    Route::resource('bookings', App\Http\Controllers\Admin\BookingController::class);
});

// VNPay IPN (Instant Payment Notification) - Must be outside auth middleware
Route::post('/payment/vnpay/ipn', [VNPayController::class, 'ipn'])->name('vnpay.ipn');

require __DIR__ . '/auth.php';
