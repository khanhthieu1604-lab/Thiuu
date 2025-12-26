<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingManagerController extends Controller
{
    /**
     * Hiển thị danh sách đơn thuê xe
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'vehicle'])
            ->latest()
            ->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Cập nhật trạng thái đơn hàng & Đồng bộ trạng thái xe
     */
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::with('vehicle')->findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        // 1. Cập nhật trạng thái đơn hàng
        $booking->update([
            'status' => $request->status
        ]);

        // 2. TỰ ĐỘNG CẬP NHẬT TRẠNG THÁI XE (Logic quan trọng)
        // Nếu duyệt đơn (confirmed) -> Xe chuyển sang "Đang thuê" (rented)
        if ($request->status === 'confirmed') {
            $booking->vehicle->update(['status' => 'rented']);
        }
        // Nếu hoàn thành (completed) hoặc hủy (cancelled) -> Xe về "Sẵn sàng" (available)
        elseif (in_array($request->status, ['completed', 'cancelled'])) {
            $booking->vehicle->update(['status' => 'available']);
        }

        return back()->with('success', 'Đã cập nhật đơn hàng và trạng thái xe thành công!');
    }
}