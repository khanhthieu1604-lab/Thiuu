<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * TRANG CHỦ: 8 xe mới nhất
     */
    public function home()
    {
        $recentVehicles = Vehicle::where('status', 'available')
            ->latest()
            ->take(8)
            ->get();

        return view('welcome', compact('recentVehicles'));
    }

    /**
     * DANH SÁCH XE: Bộ lọc tìm kiếm
     */
    public function index(Request $request)
    {
        $vehicles = Vehicle::where('status', 'available')
            // Lọc theo tên
            ->when($request->search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            // Lọc theo loại xe
            ->when($request->category, function ($query, $category) {
                return $query->where('type', $category);
            })
            // Lọc theo khoảng giá
            ->when($request->price, function ($query, $price) {
                return match ($price) {
                    'under_1m' => $query->where('rent_price_per_day', '<', 1000000),
                    '1m_2m'    => $query->whereBetween('rent_price_per_day', [1000000, 2000000]),
                    'above_2m' => $query->where('rent_price_per_day', '>', 2000000),
                    default    => $query,
                };
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * CHI TIẾT XE
     */
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        
        $relatedVehicles = Vehicle::where('id', '!=', $id)
            ->where('status', 'available')
            ->where(function($q) use ($vehicle) {
                $q->where('brand', $vehicle->brand)
                  ->orWhere('type', $vehicle->type);
            })
            ->take(4)
            ->get();

        return view('vehicles.show', compact('vehicle', 'relatedVehicles'));
    }
}