<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    // ... (Giữ nguyên hàm store cũ) ...
    public function store(Request $request)
    {
        // ... (Code cũ giữ nguyên) ...
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after:start_date',
        ]);

        $vehicle = Vehicle::findOrFail($request->vehicle_id);
        $days = Carbon::parse($request->start_date)->diffInDays(Carbon::parse($request->end_date)) ?: 1;
        $totalPrice = $days * $vehicle->rent_price_per_day;

        Booking::create([
            'user_id'     => Auth::id(),
            'vehicle_id'  => $vehicle->id,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'total_price' => $totalPrice,
            'status'      => 'pending',
            'note'        => $request->note,
        ]);

        return redirect()->route('bookings.history') // Sửa redirect về trang lịch sử
                         ->with('success', 'Đặt xe thành công! Vui lòng chờ xác nhận.');
    }

    // ==> MỚI: Xem lịch sử đặt xe của tôi
    public function history()
    {
        // Lấy danh sách booking của user đang đăng nhập
        $bookings = Booking::with('vehicle')
                           ->where('user_id', Auth::id())
                           ->latest()
                           ->paginate(5);

        return view('bookings.history', compact('bookings'));
    }
}