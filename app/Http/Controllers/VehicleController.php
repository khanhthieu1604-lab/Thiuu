<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::orderBy('created_at', 'desc');

        // 1. Thêm chức năng tìm kiếm (Search) theo tên hoặc thương hiệu
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('brand', 'like', "%$search%");
            });
        }

        // 2. Lọc theo giá
        if ($request->filled('price')) {
            if ($request->price === 'under_1m') {
                $query->where('rent_price_per_day', '<', 1000000);
            } elseif ($request->price === '1m_2m') {
                $query->whereBetween('rent_price_per_day', [1000000, 2000000]);
            } elseif ($request->price === 'above_2m') {
                $query->where('rent_price_per_day', '>', 2000000);
            }
        }

        // 3. Phân trang 12 xe/trang
        $vehicles = $query->paginate(12);

        return view('vehicles.index', compact('vehicles'));
    }

    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.show', compact('vehicle'));
    }
}