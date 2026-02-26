<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::with(['hotel', 'roomType', 'amenities']);

        // Filter by room type
        if ($request->filled('type')) {
            $query->whereHas('roomType', function ($q) use ($request) {
                $q->where('slug', $request->type);
            });
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by capacity
        if ($request->filled('guests')) {
            $query->where('capacity', '>=', $request->guests);
        }

        // Filter by availability (check_in and check_out dates)
        if ($request->filled('check_in') && $request->filled('check_out')) {
            $checkIn = Carbon::parse($request->check_in)->startOfDay();
            $checkOut = Carbon::parse($request->check_out)->startOfDay();

            $query->whereDoesntHave('bookings', function ($q) use ($checkIn, $checkOut) {
                $q->where('status', '!=', 'cancelled')
                    ->where(function ($subQ) use ($checkIn, $checkOut) {
                        $subQ->whereBetween('check_in', [$checkIn, $checkOut])
                            ->orWhereBetween('check_out', [$checkIn, $checkOut])
                            ->orWhere(function ($innerQ) use ($checkIn, $checkOut) {
                                $innerQ->where('check_in', '<=', $checkIn)
                                    ->where('check_out', '>=', $checkOut);
                            });
                    });
            });
        }

        $rooms = $query->paginate(12);
        $roomTypes = RoomType::orderBy('sort_order')->get();
        $amenities = Amenity::all();

        return view('rooms.index', compact('rooms', 'roomTypes', 'amenities'));
    }

    public function show(Room $room)
    {
        $room->load(['hotel', 'roomType', 'amenities']);

        $relatedRooms = Room::with(['hotel', 'roomType'])
            ->where('id', '!=', $room->id)
            ->where('room_type_id', $room->room_type_id)
            ->take(3)
            ->get();

        return view('rooms.show', compact('room', 'relatedRooms'));
    }
}
