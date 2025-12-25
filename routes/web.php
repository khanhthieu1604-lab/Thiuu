<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VehicleManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\RentalController;
use Illuminate\Support\Facades\Route;

// --- 1. KHU VỰC CÔNG KHAI ---
// SỬA TẠI ĐÂY: Đổi ->name('welcome') thành ->name('home')
Route::get('/', [VehicleController::class, 'home'])->name('home');

Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('vehicles.show');

// --- 2. KHU VỰC ĐĂNG NHẬP ---
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); 
    })->name('dashboard');

    Route::get('/rentals/create/{vehicle_id}', [RentalController::class, 'create'])->name('rentals.create');
    Route::post('/rentals/store', [RentalController::class, 'store'])->name('rentals.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- 3. KHU VỰC ADMIN ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/vehicles', [VehicleManagerController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/create', [VehicleManagerController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles/store', [VehicleManagerController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/{id}/edit', [VehicleManagerController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/{id}', [VehicleManagerController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/{id}', [VehicleManagerController::class, 'destroy'])->name('vehicles.destroy');
});

require __DIR__.'/auth.php';