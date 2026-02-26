<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Services\RoomService;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    protected $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::all();
        return view('hotels.index', compact('hotels'));
    }

    // ... (create, store methods skipped for brevity if not changed)

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Hotel $hotel)
    {
        $checkIn = $request->query('check_in');
        $checkOut = $request->query('check_out');
        $rooms = collect();

        if ($checkIn && $checkOut) {
            $rooms = $this->roomService->getAvailableRooms($hotel->id, $checkIn, $checkOut);
        } else {
            $rooms = $hotel->rooms;
        }

        return view('hotels.show', compact('hotel', 'rooms', 'checkIn', 'checkOut'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        //
    }
}
