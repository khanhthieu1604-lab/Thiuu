@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">Quản lý Đội xe</h2>
                <p class="text-gray-500 text-sm mt-1">Danh sách tất cả các xe trong hệ thống</p>
            </div>
            <a href="{{ route('admin.vehicles.create') }}" class="bg-blue-800 hover:bg-blue-900 text-white font-bold py-2 px-5 rounded shadow flex items-center gap-2 transition">
                <i class="fa-solid fa-plus"></i> Thêm xe mới
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
                <div class="flex items-center">
                    <i class="fa-solid fa-circle-check mr-2 text-lg"></i>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-blue-900 text-white text-xs uppercase font-bold tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Hình ảnh / Tên xe</th>
                            <th class="px-6 py-4">Phân loại</th>
                            <th class="px-6 py-4">Giá thuê (ngày)</th>
                            <th class="px-6 py-4">Trạng thái</th>
                            <th class="px-6 py-4 text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm">
                        @foreach($vehicles as $vehicle)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-14 w-20 flex-shrink-0 overflow-hidden rounded border border-gray-200 bg-gray-100">
                                        @if($vehicle->image)
                                            <img class="h-full w-full object-cover" src="{{ asset($vehicle->image) }}" alt="{{ $vehicle->name }}">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center text-gray-400">
                                                <i class="fa-solid fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-bold text-gray-900 text-base">{{ $vehicle->name }}</div>
                                        <div class="text-xs text-gray-500">ID: #{{ $vehicle->id }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-gray-900 font-medium">{{ $vehicle->brand }}</div>
                                <div class="text-xs text-gray-500 bg-gray-100 inline-block px-2 py-0.5 rounded mt-1">{{ $vehicle->type }}</div>
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-blue-800 font-bold text-base">{{ number_format($vehicle->rent_price_per_day) }}đ</span>
                            </td>

                            <td class="px-6 py-4">
                                @if($vehicle->status == 'available')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800 border border-green-200">
                                        <i class="fa-solid fa-check mr-1 mt-0.5"></i> Sẵn sàng
                                    </span>
                                @elseif($vehicle->status == 'rented')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        <i class="fa-solid fa-clock mr-1 mt-0.5"></i> Đang thuê
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gray-100 text-gray-800 border border-gray-200">
                                        <i class="fa-solid fa-wrench mr-1 mt-0.5"></i> Bảo trì
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-4">
                                    <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="text-blue-600 hover:text-blue-900 transition transform hover:scale-110" title="Chỉnh sửa">
                                        <i class="fa-solid fa-pen-to-square text-lg"></i>
                                    </a>

                                    <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('CẢNH BÁO: Bạn có chắc chắn muốn xóa xe này? Hành động này không thể hoàn tác.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 transition transform hover:scale-110" title="Xóa xe">
                                            <i class="fa-solid fa-trash text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                {{ $vehicles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection