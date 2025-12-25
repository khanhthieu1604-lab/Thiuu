<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // 1. Hiển thị trang thanh toán
    public function create($bookingId)
    {
        $booking = Booking::with('vehicle')->findOrFail($bookingId);

        // Bảo mật: Chỉ chủ đơn hàng mới được thanh toán
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền truy cập đơn hàng này.');
        }

        return view('payment.create', compact('booking'));
    }

    // 2. Xử lý thanh toán (Mô phỏng)
    public function process(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required'
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        // Cập nhật trạng thái đơn hàng thành "Đã xác nhận/Đã cọc"
        $booking->update([
            'status' => 'confirmed' // Hoặc trạng thái khác tùy logic của bạn
        ]);

        // (Ở đây có thể thêm logic lưu vào bảng payments nếu cần)

        return redirect()->route('bookings.history')
            ->with('success', 'Thanh toán thành công! Xe của bạn đã được giữ chỗ.');
    }
}