@extends('layouts.app')

@section('content')
@php
    // Class chung cho các Card để đồng bộ giao diện
    $cardClasses = 'bg-white dark:bg-zinc-900 rounded-xl border border-gray-200 dark:border-zinc-800 shadow-sm overflow-hidden';
    $textLabel = 'text-gray-500 dark:text-gray-400 text-xs uppercase font-semibold tracking-wide';
    $textValue = 'text-gray-900 dark:text-white font-bold text-sm';
@endphp

<div class="bg-gray-50 dark:bg-black min-h-screen py-8 text-sm text-gray-700 dark:text-gray-300 transition-colors duration-300 font-sans">

    <div class="container mx-auto px-4 max-w-6xl">
        
        <div class="mb-6 flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
            <a href="{{ route('vehicles.index') }}" class="hover:text-blue-700 dark:hover:text-yellow-500 transition font-medium">Danh sách xe</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span>{{ $vehicle->type ?? 'Sedan' }}</span>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="font-bold text-gray-800 dark:text-gray-200">{{ $vehicle->name }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ================= CỘT TRÁI (THÔNG TIN XE & ĐỊA ĐIỂM) ================= --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- ===== CARD 1: THÔNG TIN XE ===== --}}
                <div class="{{ $cardClasses }} p-6 relative">
                    <div class="absolute top-0 right-0 p-4">
                        @if($vehicle->status == 'available')
                            <span class="px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-bold border border-green-200 dark:border-green-800 flex items-center gap-1.5 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-600 animate-pulse"></span> Sẵn sàng
                            </span>
                        @else
                             <span class="px-3 py-1 rounded-full bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs font-bold border border-red-200 dark:border-red-800">
                                Đã được thuê
                            </span>
                        @endif
                    </div>

                    <div class="flex flex-col md:flex-row justify-between gap-8">
                        
                        {{-- Thông tin & Thông số --}}
                        <div class="space-y-5 flex-1">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white uppercase tracking-tight">{{ $vehicle->name }}</h1>
                                <p class="text-gray-500 dark:text-gray-400 text-sm flex items-center gap-2 mt-1">
                                    <span class="px-2 py-0.5 rounded bg-gray-100 dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 text-xs font-semibold">
                                        {{ $vehicle->type ?? 'Economy' }}
                                    </span>
                                    <span>hoặc dòng xe tương đương</span>
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-y-3 gap-x-4 text-sm text-gray-700 dark:text-gray-300">
                                <div class="flex items-center gap-2.5">
                                    <i class="fa-solid fa-user-group text-blue-600 dark:text-yellow-500 w-4 text-center"></i> 5 Hành khách
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <i class="fa-solid fa-suitcase text-blue-600 dark:text-yellow-500 w-4 text-center"></i> 2 Vali lớn
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <i class="fa-solid fa-gears text-blue-600 dark:text-yellow-500 w-4 text-center"></i> Số tự động
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <i class="fa-solid fa-snowflake text-blue-600 dark:text-yellow-500 w-4 text-center"></i> Máy lạnh
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <i class="fa-solid fa-road text-blue-600 dark:text-yellow-500 w-4 text-center"></i> K.giới hạn Km
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <i class="fa-solid fa-gas-pump text-blue-600 dark:text-yellow-500 w-4 text-center"></i> Xăng
                                </div>
                            </div>
                        </div>

                        {{-- Hình ảnh xe --}}
                        <div class="md:w-56 flex-shrink-0 flex items-center justify-center bg-gray-50 dark:bg-zinc-800 rounded-lg p-4 border border-gray-100 dark:border-zinc-700 group">
                            @if($vehicle->image)
                                <img src="{{ asset($vehicle->image) }}" class="w-full object-contain transform group-hover:scale-110 transition duration-700">
                            @else
                                <i class="fa-solid fa-car text-gray-300 text-6xl"></i>
                            @endif
                        </div>
                    </div>

                    <div class="border-t border-gray-100 dark:border-zinc-800 my-6"></div>

                    {{-- Đánh giá / Nhà cung cấp --}}
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-blue-800 dark:bg-zinc-800 flex items-center justify-center text-white font-bold text-xl shadow-md border border-blue-900 dark:border-zinc-700">
                                {{ substr($vehicle->brand, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white uppercase text-xs">{{ $vehicle->brand }} Collection</p>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="px-1.5 py-0.5 bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300 rounded text-[10px] font-bold border border-blue-200 dark:border-blue-800">
                                        9.8 / 10
                                    </span>
                                    <span class="font-bold text-xs text-gray-700 dark:text-gray-300">Tuyệt vời</span>
                                    <span class="text-gray-400 text-xs font-normal">(58 đánh giá)</span>
                                </div>
                            </div>
                        </div>

                        <a href="#reviews" class="text-blue-700 dark:text-yellow-500 text-xs font-bold hover:underline flex items-center gap-1">
                            Xem đánh giá <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                {{-- ===== CARD 2: ĐỊA ĐIỂM & GIỜ LÀM VIỆC ===== --}}
                <div class="{{ $cardClasses }} p-6">
                    <h2 class="text-base font-bold text-gray-900 dark:text-white uppercase mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-location-dot text-red-500"></i> Địa điểm nhận xe
                    </h2>

                    <div class="flex flex-col md:flex-row justify-between gap-8">
                        {{-- Địa chỉ --}}
                        <div class="flex items-start gap-3">
                            <div class="space-y-1">
                                <p class="{{ $textLabel }}">Trụ sở chính</p>
                                <p class="{{ $textValue }}">Thiuu Rental Hồ Chí Minh</p>
                                <p class="text-gray-500 dark:text-gray-400 text-xs leading-relaxed">
                                    123 Đường Lê Lợi, Quận 1,<br>TP. Hồ Chí Minh, Việt Nam
                                </p>
                            </div>
                        </div>

                        {{-- Giờ làm việc --}}
                        <div class="flex items-start gap-3">
                            <div class="space-y-1">
                                <p class="{{ $textLabel }}">Giờ hoạt động</p>
                                <p class="{{ $textValue }}">Thứ 2 - Chủ Nhật</p>
                                <p class="text-gray-500 dark:text-gray-400 text-xs">
                                    08:00 Sáng – 08:00 Tối
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== CARD 3: THỦ TỤC CẦN THIẾT ===== --}}
                <div class="{{ $cardClasses }} p-6">
                    <h2 class="text-base font-bold text-gray-900 dark:text-white uppercase mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-clipboard-check text-green-600"></i> Thủ tục nhận xe
                    </h2>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex gap-3">
                            <i class="fa-solid fa-id-card mt-1 text-gray-400 text-lg"></i>
                            <div>
                                <p class="font-bold text-gray-800 dark:text-gray-200 text-sm">Giấy phép lái xe</p>
                                <p class="text-gray-500 dark:text-gray-400 text-xs mt-0.5">
                                    Còn hạn sử dụng và phù hợp với loại xe thuê (B1/B2).
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <i class="fa-solid fa-address-card mt-1 text-gray-400 text-lg"></i>
                            <div>
                                <p class="font-bold text-gray-800 dark:text-gray-200 text-sm">CCCD / CMND</p>
                                <p class="text-gray-500 dark:text-gray-400 text-xs mt-0.5">
                                    Bản gốc để đối chiếu thông tin người thuê.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ================= CỘT PHẢI (THANH TOÁN & ĐẶT) ================= --}}
            <aside class="space-y-6">

                {{-- CARD TỔNG TIỀN (STICKY) --}}
                <div class="{{ $cardClasses }} p-6 space-y-5 sticky top-24 border-t-4 border-t-blue-800 dark:border-t-yellow-500">
                    
                    {{-- Giá tổng --}}
                    <div>
                        <div class="flex items-end gap-1">
                            <span class="text-3xl font-bold text-blue-800 dark:text-yellow-500">{{ number_format($vehicle->rent_price_per_day) }}đ</span>
                            <span class="text-gray-500 dark:text-gray-400 text-xs mb-1">/ ngày</span>
                        </div>
                        <p class="text-green-600 dark:text-green-400 text-xs font-bold mt-2 flex items-center gap-1.5 bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded w-fit">
                            <i class="fa-solid fa-check-circle"></i> Giá tốt nhất hôm nay
                        </p>
                    </div>

                    {{-- Chính sách hủy --}}
                    <div class="text-xs text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-zinc-800/50 p-3 rounded-lg border border-gray-100 dark:border-zinc-700">
                        <p class="font-bold mb-1 text-gray-800 dark:text-white">Hủy miễn phí</p>
                        <p>Hoàn tiền 100% nếu hủy trước 24h nhận xe.</p>
                    </div>

                    <div class="border-t border-gray-100 dark:border-zinc-800"></div>

                    {{-- Chi tiết giá --}}
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white mb-3 text-xs uppercase">Chi tiết giá</h3>
                        <div class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                            <div class="flex justify-between">
                                <span>Phí thuê xe</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ number_format($vehicle->rent_price_per_day) }}đ</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Thuế & Phí dịch vụ</span>
                                <span class="text-green-600 font-bold">0đ (Đã bao gồm)</span>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-dashed border-gray-300 dark:border-zinc-600"></div>

                    {{-- Tổng cộng --}}
                    <div class="flex justify-between items-center font-bold text-lg text-gray-900 dark:text-white">
                        <span>Tổng cộng</span>
                        <span class="text-blue-800 dark:text-yellow-500">{{ number_format($vehicle->rent_price_per_day) }}đ</span>
                    </div>

                    {{-- NÚT ĐẶT XE --}}
                    @if($vehicle->status == 'available')
                        @auth
                            <a href="{{ route('bookings.create', $vehicle->id) }}" 
                               class="block w-full py-3.5 bg-blue-800 hover:bg-blue-900 dark:bg-yellow-500 dark:hover:bg-yellow-400 text-white dark:text-black font-bold rounded-lg text-center transition shadow-lg hover:shadow-xl transform active:scale-95 text-sm uppercase tracking-wide">
                                ĐẶT XE NGAY
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="block w-full py-3.5 bg-white border-2 border-blue-800 text-blue-800 font-bold rounded-lg text-center hover:bg-blue-50 transition text-sm uppercase">
                                Đăng nhập để đặt
                            </a>
                        @endauth
                        <p class="text-[10px] text-gray-400 text-center">
                            Chưa cần thanh toán ngay. Giữ xe trong 5 phút.
                        </p>
                    @else
                        <button disabled class="w-full py-3.5 bg-gray-200 dark:bg-zinc-800 text-gray-400 dark:text-gray-600 font-bold rounded-lg cursor-not-allowed text-sm uppercase">
                            Xe tạm hết
                        </button>
                        <p class="text-[10px] text-red-500 text-center mt-2 font-medium">
                            Vui lòng chọn xe khác hoặc ngày khác.
                        </p>
                    @endif
                    
                    {{-- Hotline --}}
                    <div class="pt-4 mt-2 text-center border-t border-gray-100 dark:border-zinc-800">
                         <a href="tel:0909123456" class="text-sm font-bold text-gray-500 hover:text-blue-800 dark:hover:text-yellow-500 transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-phone-volume"></i> Hỗ trợ: 0909.123.456
                        </a>
                    </div>

                </div>

            </aside>

        </div>
    </div>

</div>
@endsection