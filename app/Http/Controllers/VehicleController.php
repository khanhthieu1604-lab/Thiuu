<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * TRANG CHỦ (Public): Hiển thị 8 xe mới nhất đang sẵn sàng.
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
     * DANH SÁCH XE (Public): Có bộ lọc tìm kiếm đầy đủ.
     */
    public function index(Request $request)
    {
        // 1. Chỉ lấy xe đang sẵn sàng (available)
        $query = Vehicle::where('status', 'available');

        // 2. Lọc theo tên xe (Search)
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 3. Lọc theo loại xe (Category)
        if ($request->filled('category')) {
            $query->where('type', $request->category); // Đảm bảo cột trong DB là 'type' hoặc sửa thành 'category_id' tùy database
        }

        // 4. Lọc theo địa điểm (Location)
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // 5. Lọc theo khoảng giá (Price Range)
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

        // 6. Phân trang & Giữ tham số tìm kiếm khi chuyển trang
        $vehicles = $query->latest()->paginate(9)->withQueryString();

        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * CHI TIẾT XE (Public): Hiển thị xe và gợi ý xe liên quan.
     */
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        
        // Logic gợi ý xe liên quan (cùng hãng hoặc cùng loại)
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