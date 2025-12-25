@extends('layouts.app')

@section('content')
<div class="bg-gray-100 dark:bg-zinc-950 min-h-screen py-8 font-sans text-sm">
    <div class="container mx-auto px-4 max-w-7xl">

        <div class="mb-8 flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Tổng quan</h1>
                <p class="text-gray-500 mt-1">Xin chào Admin, đây là tình hình kinh doanh hôm nay.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.bookings.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold shadow-sm transition">
                    <i class="fa-solid fa-list-check mr-2"></i> Quản lý Đơn
                </a>
                <a href="{{ route('admin.vehicles.index') }}" class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-lg font-bold shadow-sm transition">
                    <i class="fa-solid fa-car mr-2"></i> Quản lý Xe
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-sack-dollar"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-bold">Doanh thu</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($revenue) }}đ</h3>
                </div>
            </div>

            <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 flex items-center gap-4 relative overflow-hidden">
                @if($pendingBookings > 0)
                    <span class="absolute top-2 right-2 flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-yellow-500"></span>
                    </span>
                @endif
                <div class="w-12 h-12 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-bold">Chờ duyệt</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pendingBookings }} <span class="text-sm font-normal text-gray-400">đơn</span></h3>
                </div>
            </div>

            <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-car"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-bold">Tổng xe</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ $totalVehicles }} 
                        <span class="text-xs font-normal text-green-500 bg-green-50 px-1.5 py-0.5 rounded ml-1">
                            {{ $availableCars }} Sẵn sàng
                        </span>
                    </h3>
                </div>
            </div>

            <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-bold">Khách hàng</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 bg-white dark:bg-zinc-900 rounded-xl border border-gray-200 dark:border-zinc-800 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-gray-100 dark:border-zinc-800 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800 dark:text-white">Đơn đặt xe mới nhất</h3>
                    <a href="{{ route('admin.bookings.index') }}" class="text-xs text-blue-600 hover:underline">Xem tất cả</a>
                </div>
                <table class="w-full text-left text-xs">
                    <thead class="bg-gray-50 dark:bg-zinc-800 text-gray-500 dark:text-gray-400 uppercase">
                        <tr>
                            <th class="px-5 py-3">Khách hàng</th>
                            <th class="px-5 py-3">Xe</th>
                            <th class="px-5 py-3">Ngày nhận</th>
                            <th class="px-5 py-3">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-800">
                        @forelse($recentBookings as $booking)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50">
                            <td class="px-5 py-3 font-medium text-gray-900 dark:text-white">
                                {{ $booking->user->name }}
                                <div class="text-[10px] text-gray-400">{{ $booking->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-5 py-3">{{ $booking->vehicle->name }}</td>
                            <td class="px-5 py-3">{{ \Carbon\Carbon::parse($booking->start_date)->format('d/m/Y') }}</td>
                            <td class="px-5 py-3">
                                @if($booking->status == 'pending')
                                    <span class="text-yellow-600 font-bold">Chờ duyệt</span>
                                @elseif($booking->status == 'confirmed')
                                    <span class="text-blue-600 font-bold">Đã cọc</span>
                                @elseif($booking->status == 'completed')
                                    <span class="text-green-600 font-bold">Hoàn thành</span>
                                @else
                                    <span class="text-red-500">Hủy</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-5 py-8 text-center text-gray-400">Chưa có đơn hàng nào.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="lg:col-span-1 space-y-6">
                
                <div class="bg-white dark:bg-zinc-900 rounded-xl border border-gray-200 dark:border-zinc-800 shadow-sm p-5">
                    <h3 class="font-bold text-gray-800 dark:text-white mb-4">Tình trạng đội xe</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-600 dark:text-gray-400">Sẵn sàng (Available)</span>
                                <span class="font-bold text-gray-900 dark:text-white">{{ $availableCars }} xe</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: {{ $totalVehicles > 0 ? ($availableCars/$totalVehicles)*100 : 0 }}%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-600 dark:text-gray-400">Đang thuê / Bảo trì</span>
                                <span class="font-bold text-gray-900 dark:text-white">{{ $rentedCars }} xe</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-red-500 h-2 rounded-full" style="width: {{ $totalVehicles > 0 ? ($rentedCars/$totalVehicles)*100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-zinc-800">
                        <a href="{{ route('admin.vehicles.create') }}" class="block w-full text-center py-2 border border-dashed border-gray-300 dark:border-zinc-700 rounded text-gray-500 hover:border-blue-500 hover:text-blue-500 transition text-xs font-bold">
                            + Nhập thêm xe mới
                        </a>
                    </div>
                </div>

                <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-xl border border-yellow-200 dark:border-yellow-800 p-5">
                    <h3 class="font-bold text-yellow-800 dark:text-yellow-500 mb-2 text-xs uppercase">
                        <i class="fa-regular fa-lightbulb"></i> Mẹo quản lý
                    </h3>
                    <p class="text-xs text-yellow-700 dark:text-yellow-600 leading-relaxed">
                        Hãy kiểm tra đơn hàng "Chờ duyệt" mỗi ngày. Khách hàng thường muốn nhận được xác nhận trong vòng 15 phút sau khi chuyển khoản.
                    </p>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection