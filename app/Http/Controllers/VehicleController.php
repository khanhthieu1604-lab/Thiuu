<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // Trang chủ
    public function home()
    {
        // Lấy 8 xe mới nhất, trạng thái 'available'
        $recentVehicles = Vehicle::where('status', 'available')->latest()->take(8)->get();
        return view('welcome', compact('recentVehicles'));
    }

    // Danh sách xe (Public - Khách xem)
    public function index(Request $request)
    {
        $query = Vehicle::where('status', 'available'); // Chỉ hiện xe sẵn sàng

        // Lọc theo tên
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc theo loại
        if ($request->filled('category')) {
            $query->where('type', $request->category);
        }

        // Lọc theo giá
        if ($request->filled('price')) {
            switch ($request->price) {
                case 'under_1m':
                    $query->where('rent_price_per_day', '<', 1000000);
                    break;
                case '1m_2m':
                    $query->whereBetween('rent_price_per_day', [1000000, 2000000]);
                    break;
                case 'above_2m':
                    $query->where('rent_price_per_day', '>', 2000000);
                    break;
            }
        }

        $vehicles = $query->paginate(9);

        // QUAN TRỌNG: Phải trỏ vào thư mục 'vehicles', KHÔNG PHẢI 'admin.vehicles'
        return view('vehicles.index', compact('vehicles'));
    }

    // Chi tiết xe
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        
        // Gợi ý xe liên quan (cùng hãng hoặc cùng loại)
        $relatedVehicles = Vehicle::where('id', '!=', $id)
            ->where(function($q) use ($vehicle) {
                $q->where('brand', $vehicle->brand)
                  ->orWhere('type', $vehicle->type);
            })
            ->take(4)
            ->get();

        return view('vehicles.show', compact('vehicle', 'relatedVehicles'));
    }
}