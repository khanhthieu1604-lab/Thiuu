@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div>
            <h2 class="text-2xl font-bold dark:text-white uppercase tracking-wider">Hệ thống quản lý xe</h2>
            <p class="text-gray-500 text-sm italic">Admin Control Panel</p>
        </div>
        <a href="{{ route('admin.vehicles.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-bold text-sm shadow-lg flex items-center transition">
            <i class="fa-solid fa-plus mr-2"></i> THÊM XE MỚI
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl border dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs font-black">
                    <tr>
                        <th class="px-6 py-4">Ảnh</th>
                        <th class="px-6 py-4">Thông tin xe</th>
                        <th class="px-6 py-4">Phân loại</th>
                        <th class="px-6 py-4">Giá thuê</th>
                        <th class="px-6 py-4">Trạng thái</th>
                        <th class="px-6 py-4 text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y dark:divide-gray-700">
                    @foreach($vehicles as $vehicle)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                        <td class="px-6 py-4">
                            <img src="{{ asset($vehicle->image) }}" class="w-20 h-12 object-cover rounded shadow-sm border">
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-900 dark:text-white">{{ $vehicle->name }}</div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase">{{ $vehicle->brand }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm dark:text-gray-300 font-medium">{{ $vehicle->type }}</td>
                        <td class="px-6 py-4">
                            <span class="text-blue-600 dark:text-blue-400 font-black">{{ number_format($vehicle->rent_price_per_day) }}đ</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $vehicle->status == 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $vehicle->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-3">
                                <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="p-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-600 hover:text-white transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Xóa xe này khỏi hệ thống?')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection