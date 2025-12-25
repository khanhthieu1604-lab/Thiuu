@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10 min-h-screen">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 uppercase border-l-4 border-yellow-500 pl-4">Lịch sử chuyến đi</h1>

    @if($bookings->count() > 0)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-200">
                        <tr>
                            <th class="px-6 py-3">Mã đơn</th>
                            <th class="px-6 py-3">Xe</th>
                            <th class="px-6 py-3">Thời gian</th>
                            <th class="px-6 py-3">Tổng tiền</th>
                            <th class="px-6 py-3">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="px-6 py-4 font-bold">#{{ $booking->id }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $booking->vehicle->name ?? 'Xe đã xóa' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($booking->start_date)->format('d/m/Y') }} - 
                                    {{ \Carbon\Carbon::parse($booking->end_date)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 font-bold text-yellow-600 dark:text-yellow-500">
                                    {{ number_format($booking->total_price) }} đ
                                </td>
                                <td class="px-6 py-4">
                                    @if($booking->status == 'pending')
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2.5 py-0.5 rounded">Chờ duyệt</span>
                                    @elseif($booking->status == 'confirmed')
                                        <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-0.5 rounded">Đã duyệt</span>
                                    @elseif($booking->status == 'completed')
                                        <span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-0.5 rounded">Hoàn thành</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-bold px-2.5 py-0.5 rounded">Đã hủy</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                {{ $bookings->links() }}
            </div>
        </div>
    @else
        <div class="text-center py-20 bg-gray-50 dark:bg-gray-800 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-700">
            <p class="text-gray-500 mb-4">Bạn chưa có chuyến đi nào.</p>
            <a href="{{ route('vehicles.index') }}" class="text-yellow-500 hover:underline font-bold uppercase text-sm">Đặt xe ngay</a>
        </div>
    @endif
</div>
@endsection