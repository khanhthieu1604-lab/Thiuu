<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * WEB: Hiển thị Dashboard Admin (Blade View)
     */
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
     * API: Thống kê nhanh cho Admin (Mobile App)
     * GET /api/admin/stats
     */
    public function apiStats()
    {
        // Kiểm tra quyền Admin (Dù Middleware đã check, check thêm cũng tốt)
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized: Bạn không phải Admin'], 403);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'total_vehicles' => Vehicle::count(),
                'total_bookings' => Booking::count(),
                'pending_bookings' => Booking::where('status', 'pending')->count(),
                'total_revenue' => Booking::where('status', 'completed')->sum('total_price'),
                // Có thể thêm các thống kê khác nếu App cần
            ]
        ]);
    }
}