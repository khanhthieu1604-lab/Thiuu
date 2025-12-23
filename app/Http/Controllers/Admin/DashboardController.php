<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Rental;

class DashboardController extends Controller
{
    public function index()
    {
        // Thống kê dữ liệu cho Dashboard theo báo cáo 
        $totalVehicles = Vehicle::count();
        $totalUsers = User::where('role', 'customer')->count();
        $totalRentals = Rental::count();
        $recentVehicles = Vehicle::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalVehicles', 'totalUsers', 'totalRentals', 'recentVehicles'));
    }
}