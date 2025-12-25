<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // Hiển thị danh sách xe (Public)
    public function index(Request $request)
    {
        $query = Vehicle::query();

        // Logic lọc cơ bản nếu có
        if ($request->has('category') && $request->category != '') {
            $query->where('type', $request->category); // Giả sử cột là type
        }

        // Chỉ lấy xe đang hoạt động (hoặc lấy hết tùy ý bạn)
        $vehicles = $query->latest()->paginate(9);

        return view('vehicles.index', compact('vehicles'));
    }

    // Hiển thị chi tiết 1 xe (Public)
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.show', compact('vehicle'));
    }
}