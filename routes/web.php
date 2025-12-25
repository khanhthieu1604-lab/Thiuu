<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VehicleManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BookingController; // SỬA: Dùng BookingController thay vì RentalController
use Illuminate\Support\Facades\Route;

// --- 1. KHU VỰC CÔNG KHAI (Public) ---
Route::get('/', [VehicleController::class, 'home'])->name('home');
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('vehicles.show');

// Route tĩnh cho trang Dịch vụ
Route::view('/services', 'services')->name('services');

// --- 2. KHU VỰC NGƯỜI DÙNG ĐĂNG NHẬP ---
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); 
    })->name('dashboard');

    // --- SỬA: LOGIC ĐẶT XE (Booking System) ---
    // 1. Trang xác nhận đặt cọc
    Route::get('/bookings/create/{vehicle_id}', [BookingController::class, 'create'])->name('bookings.create');
    
    // 2. Xử lý lưu đơn đặt xe
    Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');
    
    // 3. Xem lịch sử chuyến đi của tôi (Mới)
    Route::get('/bookings/history', [BookingController::class, 'history'])->name('bookings.history');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- 3. KHU VỰC ADMIN ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Quản lý xe (CRUD)
    Route::resource('vehicles', VehicleManagerController::class);
});

require __DIR__.'/auth.php';