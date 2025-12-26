<?php

use App\Http\Controllers\VehicleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// 1. API Công khai (Không cần đăng nhập)
Route::post('/login', [AuthController::class, 'apiLogin']);
Route::get('/vehicles', [VehicleController::class, 'apiIndex']);
Route::get('/vehicles/{id}', [VehicleController::class, 'apiShow']);

// 2. API Bảo mật (Phải gửi Token kèm theo)
Route::middleware('auth:sanctum')->group(function () {
    // Lấy thông tin người đang đăng nhập
    Route::get('/profile', function (Request $request) {
        return response()->json($request->user());
    });

    // Đặt xe qua API
    Route::post('/bookings/store', [BookingController::class, 'apiStore']);
    
    // Lịch sử đặt xe
    Route::get('/bookings/my-history', [BookingController::class, 'apiHistory']);

    // Đăng xuất (Hủy token)
    Route::post('/logout', [AuthController::class, 'apiLogout']);
});