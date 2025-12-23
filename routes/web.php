<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
Route::get('/test', function () {
    return view('welcome');
});

Route::get('/', [VehicleController::class, 'index'])
    ->name('vehicles.index');

Route::get('/vehicles/{id}', [VehicleController::class, 'show'])
    ->name('vehicles.show');
