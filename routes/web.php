<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VehicleManagerController;
use App\Http\Controllers\Admin\BookingManagerController;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\Admin\UserManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

// --- 1. KHU VỰC CÔNG KHAI ---
Route::get('/', [VehicleController::class, 'home'])->name('home');
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('vehicles.show');
Route::view('/services', 'services')->name('services');

// --- 2. KHU VỰC NGƯỜI DÙNG ĐĂNG NHẬP ---
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('bookings.history');
    })->name('dashboard');

    Route::get('/bookings/create/{vehicle_id}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/history', [BookingController::class, 'history'])->name('bookings.history');
    Route::get('/bookings/{id}/contract', [BookingController::class, 'showContract'])->name('bookings.contract');

    Route::get('/payment/{booking_id}', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- 3. KHU VỰC ADMIN ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Quản lý xe & Bảo trì
    Route::resource('vehicles', VehicleManagerController::class);
    Route::get('/vehicles/{id}/manage', [VehicleManagerController::class, 'manage'])->name('vehicles.manage');
    Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');
    Route::delete('/maintenance/{id}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');

    // Quản lý đơn hàng
    Route::get('/bookings', [BookingManagerController::class, 'index'])->name('bookings.index');
    Route::patch('/bookings/{id}/status', [BookingManagerController::class, 'updateStatus'])->name('bookings.update_status');

    // Quản lý người dùng
    Route::get('/users', [UserManagerController::class, 'index'])->name('users.index');
    Route::put('/users/{id}/role', [UserManagerController::class, 'toggleRole'])->name('users.role');
    Route::delete('/users/{id}', [UserManagerController::class, 'destroy'])->name('users.destroy');
});

require __DIR__.'/auth.php';