<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function store(Request $request, $vehicleId)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after:start_date',
        ]);

        $vehicle = Vehicle::findOrFail($vehicleId);

        $start = Carbon::parse($request->start_date);
        $end   = Carbon::parse($request->end_date);

        $totalDays  = $start->diffInDays($end);
        $totalPrice = $totalDays * $vehicle->rent_price_per_day;

        Rental::create([
            'user_id'     => 1, // tạm thời
            'vehicle_id'  => $vehicle->id,
            'start_date'  => $start,
            'end_date'    => $end,
            'total_days'  => $totalDays,
            'total_price' => $totalPrice,
            'status'      => 'pending',
        ]);

        return redirect()
            ->route('vehicles.show', $vehicle->id)
            ->with('success', '🎉 Thuê xe thành công!');
    }
}
