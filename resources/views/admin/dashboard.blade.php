@extends('layouts.app')

@section('content')
{{-- Ép giao diện Dark Mode toàn diện cho Dashboard Admin --}}
<div class="bg-gray-100 dark:bg-zinc-950 min-h-screen py-8 font-sans text-sm transition-colors duration-300">
    <div class="container mx-auto px-4 max-w-7xl">

        {{-- Tiêu đề & Nút thao tác nhanh --}}
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
            <div>
                <h1 class="text-3xl font-black text-gray-800 dark:text-white uppercase tracking-tighter">Tổng quan</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Xin chào <span class="text-blue-600 font-bold">{{ Auth::user()->name }}</span>, đây là tình hình kinh doanh của Thiuu Rental.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.bookings.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl font-bold shadow-lg shadow-blue-600/20 transition-all active:scale-95">
                    <i class="fa-solid fa-list-check mr-2"></i> Xử lý Đơn
                </a>
                <a href="{{ route('admin.vehicles.index') }}" class="bg-gray-800 dark:bg-zinc-800 hover:bg-gray-900 text-white px-4 py-2.5 rounded-xl font-bold shadow-lg transition-all active:scale-95">
                    <i class="fa-solid fa-car mr-2"></i> Quản lý Xe
                </a>
            </div>
        </div>

        {{-- Hệ thống Card Thống kê --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            {{-- Card Doanh thu --}}
            <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 flex items-center gap-4 group hover:border-green-500 transition-colors">
                <div class="w-12 h-12 rounded-2xl bg-green-100 dark:bg-green-900/30 text-green-600 flex items-center justify-center text-xl shadow-inner">
                    <i class="fa-solid fa-sack-dollar"></i>
                </div>
                <div>
                    <p class="text-[10px] text-gray-500 uppercase font-black tracking-widest">Doanh thu</p>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white">{{ number_format($revenue) }}đ</h3>
                </div>
            </div>

            {{-- Card Chờ duyệt --}}
            <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 flex items-center gap-4 relative overflow-hidden group hover:border-yellow-500 transition-colors">
                @if($pendingBookings > 0)
                    <span class="absolute top-3 right-3 flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-yellow-500"></span>
                    </span>
                @endif
                <div class="w-12 h-12 rounded-2xl bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 flex items-center justify-center text-xl shadow-inner">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div>
                    <p class="text-[10px] text-gray-500 uppercase font-black tracking-widest">Chờ duyệt</p>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white">{{ $pendingBookings }} <span class="text-xs font-normal text-gray-400 uppercase">Đơn mới</span></h3>
                </div>
            </div>

            {{-- Card Đội xe --}}
            <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 flex items-center gap-4 group hover:border-blue-500 transition-colors">
                <div class="w-12 h-12 rounded-2xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 flex items-center justify-center text-xl shadow-inner">
                    <i class="fa-solid fa-car-side"></i>
                </div>
                <div>
                    <p class="text-[10px] text-gray-500 uppercase font-black tracking-widest">Đội xe</p>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white">
                        {{ $totalVehicles }} 
                        <span class="text-[10px] font-bold text-green-500 bg-green-50 dark:bg-green-900/20 px-1.5 py-0.5 rounded ml-1 uppercase">
                            {{ $availableCars }} Sẵn sàng
                        </span>
                    </h3>
                </div>
            </div>

            {{-- Card Khách hàng --}}
            <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 flex items-center gap-4 group hover:border-purple-500 transition-colors">
                <div class="w-12 h-12 rounded-2xl bg-purple-100 dark:bg-purple-900/30 text-purple-600 flex items-center justify-center text-xl shadow-inner">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <p class="text-[10px] text-gray-500 uppercase font-black tracking-widest">Khách hàng</p>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white">{{ $totalUsers }} <span class="text-xs font-normal text-gray-400 uppercase">Thành viên</span></h3>
                </div>
            </div>
        </div>

        {{-- Bảng Đơn hàng & Tình trạng đội xe --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Cột Đơn hàng (Rộng) --}}
            <div class="lg:col-span-2 bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-gray-100 dark:border-zinc-800 flex justify-between items-center bg-gray-50/50 dark:bg-zinc-800/50">
                    <h3 class="font-black text-gray-800 dark:text-white uppercase tracking-tight">Đơn đặt xe mới nhất</h3>
                    <a href="{{ route('admin.bookings.index') }}" class="text-[10px] font-black uppercase text-blue-600 hover:text-blue-500 transition">Xem tất cả <i class="fa-solid fa-arrow-right ml-1"></i></a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-gray-50 dark:bg-zinc-800 text-gray-500 dark:text-gray-400 uppercase font-black text-[10px] tracking-widest border-b dark:border-zinc-700">
                            <tr>
                                <th class="px-5 py-4">Khách hàng</th>
                                <th class="px-5 py-4">Dòng xe</th>
                                <th class="px-5 py-4">Nhận xe</th>
                                <th class="px-5 py-4 text-right">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-zinc-800">
                            @forelse($recentBookings as $booking)
                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50 transition-colors">
                                <td class="px-5 py-4">
                                    <div class="font-bold text-gray-900 dark:text-white">{{ $booking->user->name }}</div>
                                    <div class="text-[10px] text-gray-400 italic">{{ $booking->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-5 py-4 text-gray-600 dark:text-gray-300 font-medium">{{ $booking->vehicle->name }}</td>
                                <td class="px-5 py-4 text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($booking->start_date)->format('d/m/Y') }}</td>
                                <td class="px-5 py-4 text-right">
                                    @php
                                        $statusClasses = [
                                            'pending' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-500',
                                            'confirmed' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-500',
                                            'completed' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-500',
                                            'cancelled' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-500',
                                        ];
                                        $statusLabels = [
                                            'pending' => 'Chờ duyệt',
                                            'confirmed' => 'Đã cọc',
                                            'completed' => 'Hoàn thành',
                                            'cancelled' => 'Đã hủy',
                                        ];
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-md font-black uppercase text-[9px] {{ $statusClasses[$booking->status] ?? $statusClasses['pending'] }}">
                                        {{ $statusLabels[$booking->status] ?? 'Không rõ' }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-5 py-12 text-center text-gray-400 italic">Chưa có đơn hàng nào cần xử lý.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Cột Tiện ích (Hẹp) --}}
            <div class="lg:col-span-1 space-y-6">
                
                {{-- Card Tình trạng đội xe --}}
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 shadow-sm p-5">
                    <h3 class="font-black text-gray-800 dark:text-white uppercase tracking-tight mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-gauge-high text-blue-600"></i> Hiệu suất đội xe
                    </h3>
                    
                    <div class="space-y-5">
                        <div>
                            <div class="flex justify-between text-[10px] mb-2 font-bold uppercase">
                                <span class="text-gray-500">Sẵn sàng vận hành</span>
                                <span class="text-gray-900 dark:text-white">{{ $availableCars }} / {{ $totalVehicles }} Xe</span>
                            </div>
                            <div class="w-full bg-gray-100 dark:bg-zinc-800 rounded-full h-1.5 shadow-inner">
                                <div class="bg-green-500 h-1.5 rounded-full shadow-lg shadow-green-500/30 transition-all duration-1000" style="width: {{ $totalVehicles > 0 ? ($availableCars/$totalVehicles)*100 : 0 }}%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-[10px] mb-2 font-bold uppercase">
                                <span class="text-gray-500">Đang thuê & Bảo trì</span>
                                <span class="text-gray-900 dark:text-white">{{ $rentedCars }} Xe</span>
                            </div>
                            <div class="w-full bg-gray-100 dark:bg-zinc-800 rounded-full h-1.5 shadow-inner">
                                <div class="bg-red-500 h-1.5 rounded-full shadow-lg shadow-red-500/30 transition-all duration-1000" style="width: {{ $totalVehicles > 0 ? ($rentedCars/$totalVehicles)*100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-5 border-t border-gray-100 dark:border-zinc-800">
                        <a href="{{ route('admin.vehicles.create') }}" class="flex items-center justify-center gap-2 w-full py-3 border border-dashed border-gray-300 dark:border-zinc-700 rounded-xl text-gray-500 hover:border-blue-500 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/10 transition-all text-xs font-black uppercase">
                            <i class="fa-solid fa-plus-circle"></i> Nhập thêm xe mới
                        </a>
                    </div>
                </div>

                {{-- Mẹo quản lý --}}
                <div class="bg-blue-600 rounded-2xl p-6 text-white shadow-xl shadow-blue-600/20 relative overflow-hidden">
                    <i class="fa-solid fa-lightbulb absolute -bottom-4 -right-4 text-7xl opacity-10 rotate-12"></i>
                    <h3 class="font-black text-xs uppercase mb-3 flex items-center gap-2">
                         Mẹo vận hành
                    </h3>
                    <p class="text-xs leading-relaxed text-blue-100 font-medium">
                        Để tăng uy tín thương hiệu, hãy xác nhận đơn hàng "Chờ duyệt" trong vòng 15 phút. Khách hàng luôn ưu tiên các bên phản hồi nhanh chóng.
                    </p>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection