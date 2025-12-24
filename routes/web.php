<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VehicleManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

// 1. TRANG CHỦ (Danh sách xe)
Route::get('/', [VehicleController::class, 'index'])->name('vehicles.index');

// 2. TRANG WELCOME / DASHBOARD (USER THƯỜNG)
// Đây là route bị thiếu trước đó gây ra lỗi
Route::get('/dashboard', function () {
    return view('dashboard'); 
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. ADMIN AREA
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Quản lý xe
    Route::get('/vehicles', [VehicleManagerController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/create', [VehicleManagerController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles/store', [VehicleManagerController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/{id}/edit', [VehicleManagerController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/{id}', [VehicleManagerController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/{id}', [VehicleManagerController::class, 'destroy'])->name('vehicles.destroy');
});

require __DIR__.'/auth.php';