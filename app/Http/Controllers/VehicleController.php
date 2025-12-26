<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * TRANG CHỦ: Hiển thị 8 xe mới nhất
     */
    public function home()
    {
        // Điều hướng Admin về Dashboard nếu đang đăng nhập
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $brands = Vehicle::select('brand')->distinct()->get();
        
        // Lấy 8 xe đang ở trạng thái 'available'
        $vehicles = Vehicle::where('status', 'available')->latest()->take(8)->get();

        // TRỎ VỀ WELCOME THEO Ý BẠN
        return view('welcome', compact('vehicles', 'brands')); 
    }

    /**
     * DANH SÁCH XE: Bộ lọc tìm kiếm
     */
    public function index(Request $request)
    {
        $vehicles = Vehicle::where('status', 'available')
            ->when($request->search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->when($request->category, function ($query, $category) {
                return $query->where('type', $category);
            })
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