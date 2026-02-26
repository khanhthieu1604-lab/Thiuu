<?php

namespace App\Services;

use App\Models\Room;
use App\Models\Booking;
use Carbon\Carbon;

class RoomService
{
    /**
     * Check if a room is available for a given date range.
     *
     * @param int $roomId
     * @param string $checkIn
     * @param string $checkOut
     * @return bool
     */
    public function isRoomAvailable($roomId, $checkIn, $checkOut)
    {
        return !Booking::where('room_id', $roomId)
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                    ->orWhereBetween('check_out', [$checkIn, $checkOut])
                    ->orWhere(function ($q) use ($checkIn, $checkOut) {
                        $q->where('check_in', '<', $checkIn)
                            ->where('check_out', '>', $checkOut);
                    });
            })
            ->where('status', '!=', 'cancelled')
            ->exists();
    }

    /**
     * Get available rooms for a hotel in a date range.
     *
     * @param int $hotelId
     * @param string $checkIn
     * @param string $checkOut
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAvailableRooms($hotelId, $checkIn, $checkOut)
    {
        $rooms = Room::where('hotel_id', $hotelId)->get();

        return $rooms->filter(function ($room) use ($checkIn, $checkOut) {
            return $this->isRoomAvailable($room->id, $checkIn, $checkOut);
        });
    }
}
