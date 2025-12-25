<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleManagerController extends Controller
{
    // 1. Danh sách xe
    public function index()
    {
        $vehicles = Vehicle::latest()->paginate(10);
        return view('admin.vehicles.index', compact('vehicles'));
    }

    // 2. Form thêm mới
    public function create()
    {
        return view('admin.vehicles.create');
    }

    // 3. Lưu xe mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'type' => 'required', // Sedan, SUV...
            'rent_price_per_day' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable',
        ]);

        $data = $request->all();
        $data['status'] = 'available'; // Mặc định là 'Sẵn sàng'

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/vehicles'), $filename);
            $data['image'] = 'uploads/vehicles/' . $filename;
        }

        Vehicle::create($data);

        return redirect()->route('admin.vehicles.index')->with('success', 'Thêm xe thành công!');
    }

    // 4. Form chỉnh sửa (MỚI)
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    // 5. Cập nhật thông tin (MỚI)
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'rent_price_per_day' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:available,rented,maintenance',
        ]);

        $data = $request->except(['image']);

        // Xử lý ảnh mới (nếu có)
        if ($request->hasFile('image')) {
            // 1. Xóa ảnh cũ nếu có (để tiết kiệm dung lượng)
            if ($vehicle->image && file_exists(public_path($vehicle->image))) {
                unlink(public_path($vehicle->image));
            }

            // 2. Upload ảnh mới
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/vehicles'), $filename);
            $data['image'] = 'uploads/vehicles/' . $filename;
        }

        $vehicle->update($data);

        return redirect()->route('admin.vehicles.index')->with('success', 'Cập nhật thông tin xe thành công!');
    }

    // 6. Xóa xe
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        
        // Xóa ảnh khi xóa xe
        if ($vehicle->image && file_exists(public_path($vehicle->image))) {
            unlink(public_path($vehicle->image));
        }

        $vehicle->delete();
        return redirect()->route('admin.vehicles.index')->with('success', 'Đã xóa xe khỏi hệ thống!');
    }
    // Trong VehicleManagerController.php
            public function manage($id)
            {
                // Lấy thông tin xe kèm theo lịch sử bảo trì của nó
                $vehicle = \App\Models\Vehicle::with('maintenances')->findOrFail($id);
                
                return view('admin.vehicles.manage', compact('vehicle'));
            }
}