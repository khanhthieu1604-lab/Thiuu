@extends('layouts.app')

@section('content')
<div class="bg-gray-50 dark:bg-black min-h-screen py-8 font-sans text-sm transition-colors duration-300">
    <div class="container mx-auto px-4 max-w-5xl">
        
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Chuyến đi của tôi</h1>
                <p class="text-gray-500 dark:text-gray-400 text-xs mt-1">Quản lý các đơn đặt xe và trạng thái thanh toán.</p>
            </div>
            <a href="{{ route('vehicles.index') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-full transition shadow-sm">
                + Đặt xe mới
            </a>
        </div>

        @if($bookings->count() > 0)
            <div class="space-y-4">
                @foreach($bookings as $booking)
                    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-gray-200 dark:border-zinc-800 shadow-sm overflow-hidden hover:shadow-md transition duration-300">
                        <div class="flex flex-col md:flex-row">
                            
                            <div class="md:w-1/4 h-48 md:h-auto bg-gray-100 dark:bg-zinc-800 relative group overflow-hidden">
                                @if($booking->vehicle && $booking->vehicle->image)
                                    <img src="{{ asset($booking->vehicle->image) }}" class="w-full h-full object-cover object-center transform group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fa-solid fa-car text-gray-400 text-3xl"></i>
                                    </div>
                                @endif
                                
                                <div class="absolute top-2 left-2 bg-black/60 backdrop-blur text-white text-[10px] px-2 py-0.5 rounded font-mono">
                                    #{{ $booking->id }}
                                </div>
                            </div>

                            <div class="md:w-2/4 p-5 flex flex-col justify-center border-r border-gray-100 dark:border-zinc-800">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                            {{ $booking->vehicle->name ?? 'Xe đã bị xóa' }}
                                        </h3>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $booking->vehicle->brand ?? '' }} • {{ $booking->vehicle->type ?? '' }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mt-3 text-sm text-gray-600 dark:text-gray-400">
                                    <div>
                                        <p class="text-[10px] uppercase text-gray-400 font-bold mb-0.5">Nhận xe</p>
                                        <div class="flex items-center gap-2 font-medium text-gray-800 dark:text-gray-200">
                                            <i class="fa-regular fa-calendar text-blue-500"></i>
                                            {{ \Carbon\Carbon::parse($booking->start_date)->format('d/m/Y') }}
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-[10px] uppercase text-gray-400 font-bold mb-0.5">Trả xe</p>
                                        <div class="flex items-center gap-2 font-medium text-gray-800 dark:text-gray-200">
                                            <i class="fa-regular fa-calendar-check text-blue-500"></i>
                                            {{ \Carbon\Carbon::parse($booking->end_date)->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>
                                
                                @if($booking->note)
                                    <div class="mt-4 p-2 bg-gray-50 dark:bg-zinc-800 rounded text-xs text-gray-500 italic border border-gray-100 dark:border-zinc-700">
                                        "<i class="fa-regular fa-comment-dots mr-1"></i> {{ Str::limit($booking->note, 60) }}"
                                    </div>
                                @endif
                            </div>

                            <div class="md:w-1/4 p-5 bg-gray-50 dark:bg-zinc-800/50 flex flex-col justify-between items-center text-center">
                                
                                <div>
                                    <p class="text-[10px] uppercase text-gray-400 font-bold mb-1">Tổng thanh toán</p>
                                    <p class="text-xl font-bold text-blue-700 dark:text-yellow-500">{{ number_format($booking->total_price) }}đ</p>
                                </div>

                                <div class="my-3">
                                    @if($booking->status == 'pending')
                                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-bold border border-yellow-200 flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span> Chờ xác nhận
                                        </span>
                                        <p class="text-[10px] text-gray-400 mt-1">Admin đang kiểm tra</p>
                                    @elseif($booking->status == 'confirmed')
                                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-bold border border-blue-200 flex items-center gap-1.5">
                                            <i class="fa-solid fa-check-circle"></i> Đã cọc / Giữ xe
                                        </span>
                                    @elseif($booking->status == 'completed')
                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-bold border border-green-200 flex items-center gap-1.5">
                                            <i class="fa-solid fa-flag-checkered"></i> Hoàn thành
                                        </span>
                                    @elseif($booking->status == 'cancelled')
                                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-bold border border-red-200">
                                            Đã hủy
                                        </span>
                                    @endif
                                </div>

                                <div>
                                    @if($booking->status == 'pending')
                                        {{-- Nút Liên hệ Admin nếu chờ lâu --}}
                                        <a href="https://zalo.me/0909123456" target="_blank" class="text-xs font-bold text-blue-600 hover:underline">
                                            Hối thúc Admin <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
                                    @elseif($booking->status == 'confirmed')
    <a href="{{ route('bookings.contract', $booking->id) }}" target="_blank" 
       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white border border-blue-600 text-blue-700 text-xs rounded hover:bg-blue-50 transition font-bold shadow-sm">
        <i class="fa-solid fa-file-contract"></i> Xem hợp đồng
    </a>
@endif
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-8">
                    {{ $bookings->links() }}
                </div>
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-20 bg-white dark:bg-zinc-900 rounded-xl border border-dashed border-gray-300 dark:border-zinc-700">
                <div class="w-16 h-16 bg-gray-100 dark:bg-zinc-800 rounded-full flex items-center justify-center text-gray-400 text-2xl mb-4">
                    <i class="fa-regular fa-folder-open"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Chưa có chuyến đi nào</h3>
                <p class="text-gray-500 text-sm mt-1 mb-6">Bạn chưa đặt chiếc xe nào. Hãy khám phá ngay!</p>
                <a href="{{ route('vehicles.index') }}" class="px-6 py-3 bg-yellow-500 hover:bg-yellow-400 text-black font-bold rounded-lg transition shadow-lg">
                    Tìm xe ngay
                </a>
            </div>
        @endif

    </div>
</div>
@endsection