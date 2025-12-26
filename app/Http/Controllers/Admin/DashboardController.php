<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Thống kê cơ bản
        $totalVehicles = Vehicle::count();
        $totalUsers = User::where('role', '!=', 'admin')->count(); // Trừ admin ra
        
        // Đơn hàng cần xử lý gấp (Pending)
        $pendingBookings = Booking::where('status', 'pending')->count();

        // 2. Tính doanh thu (Chỉ tính đơn Đã cọc & Hoàn thành)
        $revenue = Booking::whereIn('status', ['confirmed', 'completed'])->sum('total_price');

        // 3. Lấy 5 đơn hàng mới nhất
        $recentBookings = Booking::with(['user', 'vehicle'])
            ->latest()
            ->take(5)
            ->get();

        // 4. Thống kê trạng thái xe
        $availableCars = Vehicle::where('status', 'available')->count();
        $rentedCars = Vehicle::where('status', '!=', 'available')->count();

        return view('admin.dashboard', compact(
            'totalVehicles', 
            'totalUsers', 
            'pendingBookings', 
            'revenue', 
            'recentBookings',
            'availableCars',
            'rentedCars'
        ));
    }
    /**
 * API: Thống kê nhanh cho Admin
 */
public function apiStats()
{
    if (auth()->user()->role !== 'admin') {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    return response()->json([
        'total_vehicles' => \App\Models\Vehicle::count(),
        'total_bookings' => \App\Models\Booking::count(),
        'pending_bookings' => \App\Models\Booking::where('status', 'pending')->count(),
        'total_revenue' => \App\Models\Booking::where('status', 'completed')->sum('total_price'),
    ]);
}
}