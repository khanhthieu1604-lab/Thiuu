<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    /* ============================================================
        PHẦN 1: XỬ LÝ CHO GIAO DIỆN WEB (TRÌNH DUYỆT)
    ============================================================ */

    /**
     * 1. Hiển thị form xác nhận đặt xe
     */
    public function create($vehicle_id)
    {
        $vehicle = Vehicle::findOrFail($vehicle_id);

        if ($vehicle->status !== 'available') {
            return redirect()->back()->with('error', 'Rất tiếc, xe này hiện không khả dụng.');
        }

        return view('bookings.create', compact('vehicle'));
    }

    /**
     * 2. Xử lý lưu đơn đặt xe vào CSDL (Web)
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

        $start = Carbon::parse($request->start_date);
        $end   = Carbon::parse($request->end_date);
        $days  = $start->diffInDays($end);
        if ($days < 1) $days = 1; 

        $totalPrice = $days * $vehicle->rent_price_per_day;

        $booking = Booking::create([
            'user_id'     => Auth::id(),
            'vehicle_id'  => $vehicle->id,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'total_price' => $totalPrice,
            'status'      => 'pending', 
            'note'        => $request->note,
        ]);

        return redirect()->route('payment.create', ['booking_id' => $booking->id])
                         ->with('success', 'Đơn hàng đã tạo thành công! Vui lòng thanh toán để giữ chỗ.');
    }

    /**
     * 3. Xem lịch sử đặt xe của tôi (Web)
     */
    public function history()
    {
        $bookings = Booking::with('vehicle')
                           ->where('user_id', Auth::id())
                           ->latest()
                           ->paginate(5);

        return view('bookings.history', compact('bookings'));
    }

    /**
     * 4. Xem chi tiết hợp đồng thuê xe
     */
    public function showContract($id)
    {
        $booking = Booking::with(['vehicle', 'user'])->findOrFail($id);

        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền xem hợp đồng này.');
        }

        return view('bookings.contract', compact('booking'));
    }


    /* ============================================================
        PHẦN 2: XỬ LÝ CHO API (POSTMAN / MOBILE APP)
    ============================================================ */

    /**
     * API: Lưu đơn đặt xe
     * Endpoint: POST /api/bookings/store
     */
    public function apiStore(Request $request)
    {
        // 1. Validate dữ liệu gửi lên từ Postman
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after:start_date',
        ]);

        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        // 2. Tính giá tiền
        $start = Carbon::parse($request->start_date);
        $end   = Carbon::parse($request->end_date);
        $days  = $start->diffInDays($end);
        if ($days < 1) $days = 1;

        $totalPrice = $days * $vehicle->rent_price_per_day;

        // 3. Tạo booking (Auth::id() lúc này lấy từ Token)
        $booking = Booking::create([
            'user_id'     => Auth::id(), 
            'vehicle_id'  => $vehicle->id,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'total_price' => $totalPrice,
            'status'      => 'pending',
            'note'        => $request->note,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Đặt xe thành công qua API!',
            'data' => $booking->load('vehicle')
        ], 201);
    }

    /**
     * API: Lịch sử đặt xe cá nhân
     * Endpoint: GET /api/bookings/my-history
     */
    public function apiHistory()
    {
        // Trả về JSON thay vì View
        $bookings = Booking::with('vehicle')
                           ->where('user_id', Auth::id())
                           ->latest()
                           ->get();

        return response()->json([
            'status' => 'success',
            'data' => $bookings
        ], 200);
    }
}