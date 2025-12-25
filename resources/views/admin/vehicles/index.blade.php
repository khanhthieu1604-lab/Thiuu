@extends('layouts.app')

@section('content')
<div class="bg-gray-100 dark:bg-zinc-950 min-h-screen py-8 font-sans text-sm">
    <div class="container mx-auto px-4 max-w-7xl">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white flex items-center gap-2">
                    <i class="fa-solid fa-car-side text-blue-600"></i> Hệ thống quản lý xe
                </h2>
                <p class="text-gray-500 text-xs mt-1">Quản lý đội xe, giá thuê và tình trạng bảo trì.</p>
            </div>
            <a href="{{ route('admin.vehicles.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg font-bold text-xs shadow-lg flex items-center transition transform hover:scale-105">
                <i class="fa-solid fa-plus mr-2"></i> THÊM XE MỚI
            </a>
        </div>

        <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-md border border-gray-200 dark:border-zinc-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 dark:bg-zinc-800 text-gray-500 dark:text-gray-400 uppercase text-[10px] font-bold tracking-wider border-b dark:border-zinc-700">
                        <tr>
                            <th class="px-6 py-4">Hình ảnh</th>
                            <th class="px-6 py-4">Thông tin xe</th>
                            <th class="px-6 py-4">Phân loại</th>
                            <th class="px-6 py-4">Giá thuê/ngày</th>
                            <th class="px-6 py-4">Trạng thái</th>
                            <th class="px-6 py-4 text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-800">
                        @forelse($vehicles as $vehicle)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50 transition duration-150">
                            <td class="px-6 py-4">
                                <div class="w-24 h-16 rounded-lg overflow-hidden border border-gray-200 dark:border-zinc-700 relative group">
                                    @if($vehicle->image)
                                        <img src="{{ asset($vehicle->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    @else
                                        <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900 dark:text-white text-sm">{{ $vehicle->name }}</div>
                                <div class="text-[10px] text-gray-500 uppercase mt-0.5 tracking-wide">{{ $vehicle->brand }}</div>
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-gray-100 dark:bg-zinc-800 text-gray-600 dark:text-gray-300 rounded text-xs font-medium">
                                    {{ $vehicle->type }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-blue-600 dark:text-yellow-500 font-bold font-mono text-sm">{{ number_format($vehicle->rent_price_per_day) }}đ</span>
                            </td>

                            <td class="px-6 py-4">
                                @if($vehicle->status == 'available')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Sẵn sàng
                                    </span>
                                @elseif($vehicle->status == 'maintenance')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-orange-100 text-orange-700 border border-orange-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span> Bảo trì
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200">
                                        Đang thuê
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    
                                    {{-- NÚT 1: SỬA THÔNG TIN --}}
                                    <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="p-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-500 hover:text-white border border-yellow-200 transition" title="Chỉnh sửa">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    {{-- NÚT 2: BẢO TRÌ & QUẢN LÝ (MỚI THÊM) --}}
                                    <a href="{{ route('admin.vehicles.manage', $vehicle->id) }}" class="p-2 bg-purple-50 text-purple-600 rounded-lg hover:bg-purple-600 hover:text-white border border-purple-200 transition" title="Bảo trì & Chi phí">
                                        <i class="fa-solid fa-screwdriver-wrench"></i>
                                    </a>

                                    {{-- NÚT 3: XÓA XE --}}
                                    <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa xe này? Dữ liệu đơn hàng liên quan cũng sẽ bị ảnh hưởng!')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white border border-red-200 transition" title="Xóa xe">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                <i class="fa-solid fa-car-on text-4xl mb-3 block opacity-20"></i>
                                Chưa có xe nào trong hệ thống.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-100 dark:border-zinc-800">
                {{ $vehicles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection