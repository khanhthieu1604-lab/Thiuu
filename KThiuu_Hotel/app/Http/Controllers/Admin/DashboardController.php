<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'total_revenue' => Booking::where('payment_status', 'paid')->sum('total_price'), // Only count paid bookings for revenue
            'total_hotels' => Hotel::count(),
            'total_users' => User::count(),
        ];

        // Recent bookings
        $recentBookings = Booking::with(['user', 'room.hotel'])->latest()->take(5)->get();

        // Chart Data: Last 7 Days bookings
        $chartData = [
            'labels' => [],
            'bookings' => [],
            'revenue' => []
        ];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chartData['labels'][] = now()->subDays($i)->format('M d');
            $chartData['bookings'][] = Booking::whereDate('created_at', $date)->count();
            $chartData['revenue'][] = Booking::whereDate('created_at', $date)
                ->where('payment_status', 'paid')
                ->sum('total_price');
        }

        return view('admin.dashboard', compact('stats', 'recentBookings', 'chartData'));
    }
}
