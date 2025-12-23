<?php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VehicleManagerController; // Quan trọng: Phải import cái này
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

// --- TRANG CHỦ & NGƯỜI DÙNG ---
Route::get('/', [VehicleController::class, 'index'])->name('vehicles.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- NHÓM QUẢN TRỊ (ADMIN) ---
// Dựa trên mục 7: Quản trị hệ thống trong báo cáo
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard thống kê
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Quản lý xe (Mục 4: Thêm, sửa, xóa xe)
    Route::get('/vehicles', [VehicleManagerController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/create', [VehicleManagerController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles/store', [VehicleManagerController::class, 'store'])->name('vehicles.store'); // Để lưu xe mới
    Route::get('/vehicles/{id}/edit', [VehicleManagerController::class, 'edit'])->name('vehicles.edit'); // Để sửa
    Route::put('/vehicles/{id}', [VehicleManagerController::class, 'update'])->name('vehicles.update'); // Để cập nhật
    Route::delete('/vehicles/{id}', [VehicleManagerController::class, 'destroy'])->name('vehicles.destroy'); // Để xóa
});

require __DIR__.'/auth.php';