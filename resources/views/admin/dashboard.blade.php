@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen pb-10">
    <div class="bg-blue-900 py-8 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold font-heading">Dashboard Quản Trị</h1>
            <p class="opacity-80 mt-1">Xin chào, {{ Auth::user()->name }}! Dưới đây là tình hình kinh doanh hôm nay.</p>
        </div>
    </div>

    <div class="container mx-auto px-4 -mt-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm uppercase font-bold">Tổng số xe</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalVehicles }}</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full text-blue-600">
                        <i class="fa-solid fa-car text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm uppercase font-bold">Đơn đặt xe</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalBookings }}</h3>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full text-yellow-600">
                        <i class="fa-solid fa-file-contract text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm uppercase font-bold">Khách hàng</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalUsers }}</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full text-green-600">
                        <i class="fa-solid fa-users text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm uppercase font-bold">Doanh thu</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ number_format($revenue) }}đ</h3>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full text-purple-600">
                        <i class="fa-solid fa-money-bill-wave text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow mb-8">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-lg text-gray-800">Đơn đặt xe mới nhất</h3>
                <a href="{{ route('admin.bookings.index') }}" class="text-blue-700 text-sm font-bold hover:underline">Xem tất cả</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                        <tr>
                            <th class="px-6 py-3">Mã đơn</th>
                            <th class="px-6 py-3">Khách hàng</th>
                            <th class="px-6 py-3">Xe thuê</th>
                            <th class="px-6 py-3">Ngày nhận - Trả</th>
                            <th class="px-6 py-3">Tổng tiền</th>
                            <th class="px-6 py-3">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @foreach($recentBookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-bold">#{{ $booking->id }}</td>
                            <td class="px-6 py-4">{{ $booking->user->name }}</td>
                            <td class="px-6 py-4 text-blue-700 font-medium">{{ $booking->vehicle->name }}</td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ \Carbon\Carbon::parse($booking->start_date)->format('d/m') }} - 
                                {{ \Carbon\Carbon::parse($booking->end_date)->format('d/m') }}
                            </td>
                            <td class="px-6 py-4 font-bold">{{ number_format($booking->total_price) }}đ</td>
                            <td class="px-6 py-4">
                                @if($booking->status == 'pending')
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-bold">Chờ duyệt</span>
                                @elseif($booking->status == 'confirmed')
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">Đã duyệt</span>
                                @else
                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-bold">{{ ucfirst($booking->status) }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection