<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::with('category');

        // Lọc theo loại xe
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Lọc theo giá (KHÔNG dùng match)
        if ($request->filled('price')) {
            if ($request->price === 'under_1m') {
                $query->where('rent_price_per_day', '<', 1000000);
            }

            if ($request->price === '1m_2m') {
                $query->whereBetween('rent_price_per_day', [1000000, 2000000]);
            }

            if ($request->price === 'above_2m') {
                $query->where('rent_price_per_day', '>', 2000000);
            }
        }

        $vehicles   = $query->get();
        $categories = VehicleCategory::all();

        return view('vehicles.index', compact('vehicles', 'categories'));
    }

    public function show($id)
    {
        $vehicle = Vehicle::with('category')->findOrFail($id);
        return view('vehicles.show', compact('vehicle'));
    }
} 
