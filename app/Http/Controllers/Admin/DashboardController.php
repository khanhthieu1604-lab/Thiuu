<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Booking; // Đảm bảo bạn đã có Model Booking từ bước trước
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Thống kê theo yêu cầu acc.docx mục 7.1
        $totalVehicles = Vehicle::count();
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalBookings = Booking::count();
        
        // Tính tổng doanh thu (chỉ tính đơn đã hoàn thành/xác nhận)
        $revenue = Booking::where('status', 'confirmed')->sum('total_price');

        // Lấy 5 đơn mới nhất
        $recentBookings = Booking::with(['user', 'vehicle'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalVehicles', 'totalUsers', 'totalBookings', 'revenue', 'recentBookings'));
    }
}