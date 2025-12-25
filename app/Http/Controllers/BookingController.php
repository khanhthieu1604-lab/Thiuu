<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * 1. Hiển thị form xác nhận đặt xe
     * Route: /bookings/create/{vehicle_id}
     */
    public function create($vehicle_id)
    {
        $vehicle = Vehicle::findOrFail($vehicle_id);

        // Kiểm tra kỹ: Nếu xe không sẵn sàng thì không cho vào trang đặt
        if ($vehicle->status !== 'available') {
            return redirect()->back()->with('error', 'Rất tiếc, xe này hiện không khả dụng.');
        }

        return view('bookings.create', compact('vehicle'));
    }

    /**
     * 2. Xử lý lưu đơn đặt xe vào CSDL
     * Route: POST /bookings/store
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after:start_date',
        ], [
            'start_date.after_or_equal' => 'Ngày nhận xe không được chọn trong quá khứ.',
            'end_date.after'            => 'Ngày trả xe phải sau ngày nhận xe.',
        ]);

        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        // Tính toán số ngày và tổng tiền
        $start = Carbon::parse($request->start_date);
        $end   = Carbon::parse($request->end_date);
        $days  = $start->diffInDays($end);
        
        // Nếu khách thuê sáng -> chiều trả trong ngày thì tính là 1 ngày
        if ($days < 1) $days = 1; 

        $totalPrice = $days * $vehicle->rent_price_per_day;

        // Tạo đơn đặt xe
        $booking = Booking::create([
            'user_id'     => Auth::id(),
            'vehicle_id'  => $vehicle->id,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'total_price' => $totalPrice,
            'status'      => 'pending', // Mặc định là chờ duyệt
            'note'        => $request->note,
        ]);

        // Chuyển hướng sang trang THANH TOÁN
        return redirect()->route('payment.create', ['booking_id' => $booking->id])
                         ->with('success', 'Đơn hàng đã tạo thành công! Vui lòng thanh toán để giữ chỗ.');
    }

    /**
     * 3. Xem lịch sử đặt xe của tôi
     * Route: /bookings/history
     */
    public function history()
    {
        // Lấy danh sách booking của user đang đăng nhập
        $bookings = Booking::with('vehicle')
                           ->where('user_id', Auth::id())
                           ->latest() // Đơn mới nhất lên đầu
                           ->paginate(5);

        return view('bookings.history', compact('bookings'));
    }

    /**
     * 4. Xem chi tiết hợp đồng thuê xe (BỔ SUNG LẠI)
     * Route: /bookings/{id}/contract
     */
    public function showContract($id)
    {
        $booking = Booking::with(['vehicle', 'user'])->findOrFail($id);

        // Bảo mật: Chỉ chủ đơn hàng mới được xem
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền xem hợp đồng này.');
        }

        return view('bookings.contract', compact('booking'));
    }
}