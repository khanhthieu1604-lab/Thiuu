@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-blue-900 font-heading">Cập nhật thông tin xe</h1>
                <p class="mt-2 text-sm text-gray-600">Chỉnh sửa thông tin chi tiết cho xe: <span class="font-bold text-blue-800">{{ $vehicle->name }}</span></p>
            </div>
            <a href="{{ route('admin.vehicles.index') }}" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-bold py-2 px-4 rounded-lg shadow-sm transition flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Quay lại
            </a>
        </div>

        <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-blue-800">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Thông tin cơ bản</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tên xe <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $vehicle->name) }}" required 
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-800 focus:bg-white transition font-medium text-gray-800"
                                    placeholder="Ví dụ: Mazda CX-5 Premium">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Hãng sản xuất</label>
                                <select name="brand" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-800 focus:bg-white transition">
                                    <option value="Toyota" {{ $vehicle->brand == 'Toyota' ? 'selected' : '' }}>Toyota</option>
                                    <option value="Honda" {{ $vehicle->brand == 'Honda' ? 'selected' : '' }}>Honda</option>
                                    <option value="Mazda" {{ $vehicle->brand == 'Mazda' ? 'selected' : '' }}>Mazda</option>
                                    <option value="Hyundai" {{ $vehicle->brand == 'Hyundai' ? 'selected' : '' }}>Hyundai</option>
                                    <option value="Kia" {{ $vehicle->brand == 'Kia' ? 'selected' : '' }}>Kia</option>
                                    <option value="Ford" {{ $vehicle->brand == 'Ford' ? 'selected' : '' }}>Ford</option>
                                    <option value="Mercedes" {{ $vehicle->brand == 'Mercedes' ? 'selected' : '' }}>Mercedes</option>
                                    <option value="VinFast" {{ $vehicle->brand == 'VinFast' ? 'selected' : '' }}>VinFast</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Phân khúc</label>
                                <select name="type" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-800 focus:bg-white transition">
                                    <option value="Sedan" {{ $vehicle->type == 'Sedan' ? 'selected' : '' }}>Sedan (4 chỗ)</option>
                                    <option value="SUV" {{ $vehicle->type == 'SUV' ? 'selected' : '' }}>SUV (5-7 chỗ)</option>
                                    <option value="Hatchback" {{ $vehicle->type == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                                    <option value="Limousine" {{ $vehicle->type == 'Limousine' ? 'selected' : '' }}>Limousine VIP</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Giá thuê / ngày <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="number" name="rent_price_per_day" value="{{ old('rent_price_per_day', $vehicle->rent_price_per_day) }}" required 
                                        class="w-full bg-blue-50 border border-blue-200 rounded-lg pl-4 pr-12 py-3 focus:outline-none focus:border-blue-800 text-blue-900 font-bold text-lg" placeholder="0">
                                    <span class="absolute right-4 top-3.5 text-blue-800 text-xs font-bold">VNĐ</span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Trạng thái xe</label>
                                <select name="status" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-800 focus:bg-white transition font-medium">
                                    <option value="available" {{ $vehicle->status == 'available' ? 'selected' : '' }}>🟢 Sẵn sàng phục vụ</option>
                                    <option value="rented" {{ $vehicle->status == 'rented' ? 'selected' : '' }}>🔴 Đang có khách thuê</option>
                                    <option value="maintenance" {{ $vehicle->status == 'maintenance' ? 'selected' : '' }}>🔧 Đang bảo trì / Sửa chữa</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Mô tả chi tiết & Ghi chú</label>
                        <textarea name="description" rows="5" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-800 focus:bg-white transition" placeholder="Nhập thông tin chi tiết về xe (màu sắc, biển số, tiện nghi...)...">{{ old('description', $vehicle->description) }}</textarea>
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-yellow-500">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Hình ảnh xe</h3>
                        
                        <div class="mb-4">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Ảnh hiện tại</label>
                            <div class="rounded-lg overflow-hidden border-2 border-dashed border-gray-300 bg-gray-50 relative group">
                                @if($vehicle->image)
                                    <img src="{{ asset($vehicle->image) }}" class="w-full h-48 object-cover">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition duration-300"></div>
                                @else
                                    <div class="h-48 flex flex-col items-center justify-center text-gray-400">
                                        <i class="fa-solid fa-image text-4xl mb-2"></i>
                                        <span class="text-sm">Chưa có ảnh</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Tải lên ảnh mới</label>
                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-blue-200 border-dashed rounded-lg cursor-pointer bg-blue-50 hover:bg-blue-100 transition">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fa-solid fa-cloud-arrow-up text-3xl text-blue-500 mb-2"></i>
                                    <p class="text-xs text-blue-600 font-semibold">Nhấn để chọn ảnh</p>
                                    <p class="text-[10px] text-gray-500 mt-1">JPG, PNG (Max 2MB)</p>
                                </div>
                                <input name="image" type="file" class="hidden" />
                            </label>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6">
                        <button type="submit" class="w-full bg-blue-800 hover:bg-blue-900 text-white font-bold py-3.5 rounded-lg shadow-lg hover:shadow-xl transform active:scale-95 transition duration-200 uppercase tracking-wide text-sm flex items-center justify-center">
                            <i class="fa-solid fa-save mr-2"></i> Lưu thay đổi
                        </button>
                        <a href="{{ route('admin.vehicles.index') }}" class="block text-center mt-4 text-sm text-gray-500 hover:text-red-600 transition">
                            Hủy bỏ thay đổi
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection