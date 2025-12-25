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
        // Sử dụng eager loading (with) để tối ưu truy vấn SQL
        $bookings = Booking::with(['user', 'vehicle'])
            ->latest()
            ->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Cập nhật trạng thái đơn hàng (Duyệt/Hủy)
     */
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Đã cập nhật trạng thái đơn hàng thành công!');
    }
}