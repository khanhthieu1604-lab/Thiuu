<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\VehicleApiController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// 1. PUBLIC API
Route::post('/login', [AuthApiController::class, 'login']); // Sửa từ apiLogin thành login
Route::get('/vehicles', [VehicleApiController::class, 'index']); // Sửa từ apiIndex thành index
Route::get('/vehicles/{id}', [VehicleApiController::class, 'show']); // Sửa từ apiShow thành show

// 2. PROTECTED API (Cần Token)
Route::middleware('auth:sanctum')->group(function () {
    // User Profile
    Route::get('/profile', function (Request $request) { 
        return $request->user(); 
    });
    Route::put('/profile/update', [ProfileController::class, 'apiUpdate']);
    Route::post('/logout', [AuthApiController::class, 'logout']); // Sửa từ apiLogout thành logout

    // Bookings (Khách hàng)
    Route::post('/bookings/store', [BookingController::class, 'apiStore']);
    Route::get('/bookings/my-history', [BookingController::class, 'apiHistory']);

    // ADMIN ONLY (Yêu cầu role admin)
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/stats', [DashboardController::class, 'apiStats']);
        Route::get('/bookings', [BookingController::class, 'apiAllBookings']);
        Route::patch('/bookings/{id}/status', [BookingController::class, 'apiUpdateStatus']);
        Route::post('/vehicles', [VehicleApiController::class, 'apiStore']); 
    });
});