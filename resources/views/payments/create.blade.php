@extends('layouts.app')

@section('content')
<div class="bg-gray-50 dark:bg-black min-h-screen py-10 transition-colors duration-300 font-sans text-sm">
    <div class="container mx-auto px-4 max-w-4xl">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <i class="fa-solid fa-credit-card text-blue-600 dark:text-yellow-500"></i> Thanh toán an toàn
            </h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- CỘT TRÁI: THÔNG TIN ĐƠN HÀNG --}}
            <div class="space-y-6">
                <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-800 p-6">
                    <h2 class="font-bold text-gray-800 dark:text-white uppercase text-xs mb-4 border-b border-gray-100 dark:border-zinc-800 pb-2">
                        Tóm tắt đơn hàng #{{ $booking->id }}
                    </h2>
                    
                    <div class="flex gap-4 mb-4">
                        <div class="w-24 h-24 bg-gray-100 dark:bg-zinc-800 rounded-lg overflow-hidden flex items-center justify-center border border-gray-200 dark:border-zinc-700">
                             @if($booking->vehicle->image)
                                <img src="{{ asset($booking->vehicle->image) }}" class="w-full h-full object-cover">
                            @else
                                <i class="fa-solid fa-car text-2xl text-gray-400"></i>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 dark:text-white text-base">{{ $booking->vehicle->name }}</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $booking->vehicle->type }} • {{ $booking->vehicle->brand }}</p>
                            <div class="mt-2 text-xs text-gray-600 dark:text-gray-300 space-y-1">
                                <p><i class="fa-regular fa-calendar-check mr-1"></i> Nhận: {{ \Carbon\Carbon::parse($booking->start_date)->format('d/m/Y') }}</p>
                                <p><i class="fa-regular fa-calendar-xmark mr-1"></i> Trả: {{ \Carbon\Carbon::parse($booking->end_date)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center bg-blue-50 dark:bg-zinc-800 p-4 rounded-lg">
                        <span class="font-bold text-gray-700 dark:text-gray-300">Tổng thanh toán</span>
                        <span class="font-bold text-2xl text-blue-800 dark:text-yellow-500">{{ number_format($booking->total_price) }}đ</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-800 p-6">
                    <h2 class="font-bold text-gray-800 dark:text-white uppercase text-xs mb-4">Chọn phương thức</h2>
                    
                    <form id="paymentForm" action="{{ route('payment.process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 p-3 border border-blue-600 bg-blue-50 dark:bg-zinc-800 dark:border-yellow-500 rounded-lg cursor-pointer transition">
                                <input type="radio" name="payment_method" value="qr_code" checked class="text-blue-600 focus:ring-blue-500">
                                <div class="flex-1">
                                    <span class="font-bold text-gray-900 dark:text-white block">Chuyển khoản QR Code 24/7</span>
                                    <span class="text-xs text-gray-500">Duyệt tự động, nhanh chóng</span>
                                </div>
                                <i class="fa-solid fa-qrcode text-xl text-blue-600 dark:text-yellow-500"></i>
                            </label>

                            <label class="flex items-center gap-3 p-3 border border-gray-200 dark:border-zinc-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-zinc-800 transition opacity-60">
                                <input type="radio" name="payment_method" value="cash" disabled class="text-gray-400">
                                <div class="flex-1">
                                    <span class="font-bold text-gray-400 block">Tiền mặt tại quầy</span>
                                    <span class="text-xs text-gray-400">Chỉ áp dụng khách hàng thân thiết</span>
                                </div>
                                <i class="fa-solid fa-money-bill-wave text-xl text-gray-400"></i>
                            </label>
                        </div>
                    </form>
                </div>
            </div>

            {{-- CỘT PHẢI: MÃ QR --}}
            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-lg border border-gray-200 dark:border-zinc-800 p-8 flex flex-col items-center justify-center text-center">
                
                <div class="bg-white p-2 rounded-xl shadow-inner border border-gray-100 mb-6 inline-block">
                    <img src="https://img.vietqr.io/image/MB-0000000000-compact2.png?amount={{ $booking->total_price }}&addInfo=THUE XE {{ $booking->id }}&accountName=THIUU RENTAL" 
                         alt="QR Code" class="w-64 h-64 object-contain">
                </div>

                <p class="text-xs text-gray-500 uppercase font-bold mb-1">Nội dung chuyển khoản</p>
                <div class="flex items-center gap-2 bg-yellow-100 dark:bg-yellow-900/30 px-3 py-1.5 rounded text-yellow-800 dark:text-yellow-500 font-mono font-bold text-lg mb-6">
                    THUE XE {{ $booking->id }} <i class="fa-regular fa-copy cursor-pointer" title="Sao chép"></i>
                </div>

                <p class="text-xs text-gray-500 dark:text-gray-400 mb-6 max-w-xs">
                    Vui lòng quét mã QR hoặc chuyển khoản theo đúng nội dung trên. Hệ thống sẽ tự động xác nhận sau 1-2 phút.
                </p>

                <button onclick="document.getElementById('paymentForm').submit();" 
                        class="w-full py-4 bg-blue-800 hover:bg-blue-900 dark:bg-yellow-500 dark:hover:bg-yellow-400 text-white dark:text-black font-bold rounded-lg uppercase tracking-wide shadow-lg transition transform active:scale-95">
                    <i class="fa-solid fa-check-circle mr-2"></i> Xác nhận đã thanh toán
                </button>

            </div>

        </div>
    </div>
</div>
@endsection