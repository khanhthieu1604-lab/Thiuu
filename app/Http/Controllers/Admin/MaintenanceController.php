<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    // Lưu thông tin bảo trì mới
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required',
            'type' => 'required',
            'cost' => 'required|numeric',
            'maintenance_date' => 'required|date',
        ]);

        Maintenance::create($request->all());

        return redirect()->back()->with('success', 'Đã thêm lịch sử bảo trì thành công!');
    }

    // Xóa lịch sử (nếu nhập sai)
    public function destroy($id)
    {
        Maintenance::destroy($id);
        return redirect()->back()->with('success', 'Đã xóa bản ghi bảo trì.');
    }
}