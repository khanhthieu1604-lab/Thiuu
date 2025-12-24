<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VehicleManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

// 1. TRANG CHỦ (Giao diện Welcome Dark Mode)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// 2. DASHBOARD (Giao diện User Dark Mode)
Route::get('/dashboard', function () {
    return view('dashboard'); 
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. DANH SÁCH XE (Trang xem sản phẩm)
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');

// 4. PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 5. ADMIN AREA
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