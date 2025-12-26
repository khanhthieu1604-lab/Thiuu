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
     * 1. Hiển thị form xác nhận đặt xe (Sửa lỗi thiếu hàm này)
     */
    public function create($vehicle_id)
    {
        $vehicle = Vehicle::findOrFail($vehicle_id);

        // Kiểm tra nếu xe đang bảo trì hoặc đã cho thuê
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
        
        // Tính số ngày (ít nhất là 1 ngày)
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

        // Chuyển hướng sang trang thanh toán
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
     * 4. Xem chi tiết hợp đồng thuê xe (Web)
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
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after:start_date',
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

        return response()->json([
            'status' => 'success',
            'message' => 'Đặt xe thành công!',
            'data' => $booking->load('vehicle')
        ], 201);
    }

    /**
     * API: Lịch sử đặt xe cá nhân
     * Endpoint: GET /api/bookings/my-history
     */
    public function apiHistory()
    {
        $bookings = Booking::with('vehicle')
                           ->where('user_id', Auth::id())
                           ->latest()
                           ->get();

        return response()->json([
            'status' => 'success',
            'data' => $bookings
        ], 200);
    }

    /**
     * API: Admin lấy danh sách đơn (cho App quản lý)
     */
    public function apiAllBookings()
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        return response()->json(['data' => Booking::with(['vehicle', 'user'])->latest()->get()]);
    }

    /**
     * API: Admin cập nhật trạng thái đơn
     */
    public function apiUpdateStatus(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        
        $request->validate(['status' => 'required|in:confirmed,completed,cancelled']);
        
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        // Cập nhật trạng thái xe tương ứng
        if ($request->status === 'confirmed') {
            $booking->vehicle->update(['status' => 'rented']);
        } elseif (in_array($request->status, ['completed', 'cancelled'])) {
            $booking->vehicle->update(['status' => 'available']);
        }

        return response()->json(['message' => 'Success', 'data' => $booking]);
    }
}