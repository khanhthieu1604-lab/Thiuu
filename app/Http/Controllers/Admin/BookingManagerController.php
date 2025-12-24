<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingManagerController extends Controller
{
    // 1. Xem danh sách đơn hàng
    public function index()
    {
        // Lấy đơn mới nhất lên đầu, kèm thông tin User và Vehicle
        $bookings = Booking::with(['user', 'vehicle'])->latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    // 2. Cập nhật trạng thái đơn (Duyệt/Hủy)
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Validate dữ liệu đầu vào
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $booking->status = $request->status;
        $booking->save();

        // (Mở rộng) Nếu duyệt đơn thì có thể cập nhật trạng thái xe thành "Đang bận"
        // if ($request->status == 'confirmed') {
        //     $booking->vehicle->update(['status' => 'rented']);
        // }

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}