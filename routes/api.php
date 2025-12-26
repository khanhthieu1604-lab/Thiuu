<?php

use App\Http\Controllers\VehicleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// 1. PUBLIC API
Route::post('/login', [AuthController::class, 'apiLogin']);
Route::get('/vehicles', [VehicleController::class, 'apiIndex']);
Route::get('/vehicles/{id}', [VehicleController::class, 'apiShow']);

// 2. PROTECTED API (Cần Token)
Route::middleware('auth:sanctum')->group(function () {
    // User Profile
    Route::get('/profile', function (Request $request) { return $request->user(); });
    Route::put('/profile/update', [ProfileController::class, 'apiUpdate']);
    Route::post('/logout', [AuthController::class, 'apiLogout']);

    // Bookings (Khách hàng)
    Route::post('/bookings/store', [BookingController::class, 'apiStore']);
    Route::get('/bookings/my-history', [BookingController::class, 'apiHistory']);

    // ADMIN ONLY (Yêu cầu role admin)
    Route::prefix('admin')->group(function () {
        Route::get('/stats', [DashboardController::class, 'apiStats']);
        Route::get('/bookings', [BookingController::class, 'apiAllBookings']);
        Route::patch('/bookings/{id}/status', [BookingController::class, 'apiUpdateStatus']);
        Route::post('/vehicles', [VehicleController::class, 'apiStore']);
    });
});