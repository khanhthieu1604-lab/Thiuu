<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Services\RoomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    protected $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    /**
     * Show the booking history for the user.
     */
    public function index()
    {
        $bookings = Auth::user()->bookings()->with(['room.hotel'])->orderBy('created_at', 'desc')->get();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create(Request $request, Room $room)
    {
        $checkIn = $request->query('check_in');
        $checkOut = $request->query('check_out');

        if (!$checkIn || !$checkOut) {
            return redirect()->back()->with('error', 'Please select check-in and check-out dates.');
        }

        // Verify availability again just in case
        if (!$this->roomService->isRoomAvailable($room->id, $checkIn, $checkOut)) {
            return redirect()->back()->with('error', 'Room is no longer available for these dates.');
        }

        $start = Carbon::parse($checkIn);
        $end = Carbon::parse($checkOut);
        $nights = $start->diffInDays($end);
        $totalPrice = $nights * $room->price;

        return view('bookings.create', compact('room', 'checkIn', 'checkOut', 'nights', 'totalPrice'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:hotel_rooms,id',
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'payment_method' => 'required|in:cod,vnpay',
        ]);

        $room = Room::findOrFail($request->room_id);

        // Final Atomic Availability Check
        if (!$this->roomService->isRoomAvailable($room->id, $request->check_in, $request->check_out)) {
            return redirect()->route('hotels.show', $room->hotel_id)
                ->with('error', 'Sorry, this room was just booked by someone else.');
        }

        $start = Carbon::parse($request->check_in);
        $end = Carbon::parse($request->check_out);
        $nights = $start->diffInDays($end);
        $totalPrice = $nights * $room->price;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_price' => $totalPrice,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'status' => 'pending' // Changed from 'confirmed' to 'pending' until payment
        ]);

        // Handle payment method
        if ($request->payment_method === 'vnpay') {
            // Redirect to VNPay payment gateway
            $paymentService = app(\App\Services\PaymentGatewayService::class);
            $paymentUrl = $paymentService->createPaymentUrl($booking);

            return redirect($paymentUrl);
        }

        // COD payment - confirm booking immediately
        $booking->update([
            'payment_status' => 'cod',
            'status' => 'confirmed'
        ]);

        // Send Confirmation Email
        try {
            \Illuminate\Support\Facades\Mail::to(Auth::user())->send(new \App\Mail\BookingConfirmation($booking));
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
        }

        return redirect()->route('bookings.index')->with('success', 'Booking confirmed successfully! Confirmation email sent.');
    }

    /**
     * Cancel a booking.
     */
    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status === 'cancelled') {
            return redirect()->back()->with('error', 'Booking is already cancelled.');
        }

        $booking->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }
}
