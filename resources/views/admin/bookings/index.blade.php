@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Quản lý Hợp đồng thuê xe</h2>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-blue-900 text-white text-xs uppercase">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Khách hàng</th>
                    <th class="px-6 py-4">Xe / Biển số</th>
                    <th class="px-6 py-4">Thời gian</th>
                    <th class="px-6 py-4">Tổng tiền</th>
                    <th class="px-6 py-4">Trạng thái</th>
                    <th class="px-6 py-4 text-center">Hành động</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($bookings as $booking)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-bold text-gray-500">#{{ $booking->id }}</td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-gray-800">{{ $booking->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $booking->user->email }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-medium text-blue-700">{{ $booking->vehicle->name }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        <div>Từ: {{ \Carbon\Carbon::parse($booking->start_date)->format('d/m/Y') }}</div>
                        <div>Đến: {{ \Carbon\Carbon::parse($booking->end_date)->format('d/m/Y') }}</div>
                    </td>
                    <td class="px-6 py-4 font-bold text-green-600">
                        {{ number_format($booking->total_price) }}đ
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="text-xs font-bold rounded px-2 py-1 border-0 cursor-pointer focus:ring-2 focus:ring-blue-500
                                {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $booking->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $booking->status == 'completed' ? 'bg-gray-100 text-gray-800' : '' }}
                            ">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Đã duyệt</option>
                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button class="text-gray-400 hover:text-blue-600"><i class="fa-solid fa-eye"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection