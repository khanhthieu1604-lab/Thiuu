@extends('layouts.app')

@section('content')
<div class="bg-gray-50 dark:bg-black min-h-screen py-10 transition-colors duration-300 font-sans text-sm">
    <div class="container mx-auto px-4 max-w-5xl">

        <div class="mb-6">
            <a href="{{ route('vehicles.show', $vehicle->id) }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-blue-700 dark:hover:text-yellow-500 transition font-medium">
                <i class="fa-solid fa-arrow-left"></i> Quay lại chi tiết xe
            </a>
        </div>

        <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm">
            @csrf
            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
            <input type="hidden" id="price_per_day" value="{{ $vehicle->rent_price_per_day }}">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- ================= CỘT TRÁI: FORM NHẬP LIỆU ================= --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-800 p-6">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                            <i class="fa-regular fa-calendar-check text-blue-600 dark:text-yellow-500"></i>
                            Thời gian thuê xe
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 uppercase">Ngày nhận xe</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-regular fa-calendar text-gray-400"></i>
                                    </div>
                                    <input type="date" name="start_date" id="start_date" required 
                                        min="{{ date('Y-m-d') }}"
                                        class="pl-10 w-full bg-gray-50 dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500 dark:text-white transition">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 uppercase">Ngày trả xe</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-regular fa-calendar text-gray-400"></i>
                                    </div>
                                    <input type="date" name="end_date" id="end_date" required 
                                        min="{{ date('Y-m-d') }}"
                                        class="pl-10 w-full bg-gray-50 dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500 dark:text-white transition">
                                </div>
                            </div>
                        </div>

                        <div id="duration_info" class="mt-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-blue-800 dark:text-blue-300 text-xs hidden flex items-center gap-2">
                            <i class="fa-solid fa-clock"></i>
                            <span>Tổng thời gian thuê: <b id="days_count">0</b> ngày</span>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-800 p-6">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                            <i class="fa-regular fa-id-card text-blue-600 dark:text-yellow-500"></i>
                            Thông tin người đặt
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 opacity-75">
                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase">Họ và tên</label>
                                <input type="text" value="{{ Auth::user()->name }}" readonly class="w-full mt-1 bg-gray-100 dark:bg-zinc-800 border-none rounded-lg p-3 text-sm text-gray-500 cursor-not-allowed">
                            </div>
                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase">Email xác nhận</label>
                                <input type="text" value="{{ Auth::user()->email }}" readonly class="w-full mt-1 bg-gray-100 dark:bg-zinc-800 border-none rounded-lg p-3 text-sm text-gray-500 cursor-not-allowed">
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-2 italic">* Thông tin được lấy từ tài khoản đăng nhập của bạn.</p>
                    </div>

                    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-800 p-6">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Ghi chú thêm</h2>
                        <textarea name="note" rows="3" placeholder="Ví dụ: Tôi muốn nhận xe tại sân bay Tân Sơn Nhất lúc 10h..." 
                            class="w-full bg-gray-50 dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-lg p-3 text-sm focus:ring-blue-500 dark:text-white transition"></textarea>
                    </div>

                </div>

                {{-- ================= CỘT PHẢI: HÓA ĐƠN TẠM TÍNH (STICKY) ================= --}}
                <div class="lg:col-span-1">
                    <div class="sticky top-6 space-y-6">
                        
                        <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-800 overflow-hidden">
                            <div class="h-40 bg-gray-100 dark:bg-zinc-800 relative flex items-center justify-center p-4">
                                @if($vehicle->image)
                                    <img src="{{ asset($vehicle->image) }}" class="max-h-full object-contain">
                                @else
                                    <i class="fa-solid fa-car text-4xl text-gray-400"></i>
                                @endif
                            </div>
                            <div class="p-5 border-b border-gray-100 dark:border-zinc-800">
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">{{ $vehicle->brand }}</p>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $vehicle->name }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $vehicle->type }} • 5 Chỗ • Số tự động</p>
                            </div>
                            <div class="p-5 bg-gray-50 dark:bg-zinc-800/50">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600 dark:text-gray-400">Đơn giá / ngày</span>
                                    <span class="font-bold text-gray-900 dark:text-white">{{ number_format($vehicle->rent_price_per_day) }}đ</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-lg border-t-4 border-t-blue-800 dark:border-t-yellow-500 p-6">
                            <h3 class="font-bold text-gray-900 dark:text-white mb-4 text-base uppercase">Chi tiết thanh toán</h3>
                            
                            <div class="space-y-3 text-sm mb-6">
                                <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                    <span>Giá thuê x <span id="bill_days">1</span> ngày</span>
                                    <span class="font-medium" id="bill_subtotal">{{ number_format($vehicle->rent_price_per_day) }}đ</span>
                                </div>
                                <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                    <span>Phí dịch vụ</span>
                                    <span class="text-green-600 font-bold">Miễn phí</span>
                                </div>
                                <div class="border-t border-dashed border-gray-200 dark:border-zinc-700 my-2"></div>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-gray-900 dark:text-white text-lg">Tổng cộng</span>
                                    <span class="font-bold text-blue-800 dark:text-yellow-500 text-2xl" id="bill_total">{{ number_format($vehicle->rent_price_per_day) }}đ</span>
                                </div>
                            </div>

                            <button type="submit" class="w-full py-4 bg-blue-800 hover:bg-blue-900 dark:bg-yellow-500 dark:hover:bg-yellow-400 text-white dark:text-black font-bold rounded-lg uppercase tracking-wider shadow-lg transition transform active:scale-95 text-sm flex justify-center items-center gap-2">
                                <span>Xác nhận đặt xe</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                            
                            <p class="text-[10px] text-gray-400 text-center mt-3">
                                Bằng việc xác nhận, bạn đồng ý với điều khoản sử dụng của Thiuu Rental.
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const pricePerDay = parseInt(document.getElementById('price_per_day').value);
        
        const daysCountEl = document.getElementById('days_count');
        const durationInfoEl = document.getElementById('duration_info');
        const billDaysEl = document.getElementById('bill_days');
        const billSubtotalEl = document.getElementById('bill_subtotal');
        const billTotalEl = document.getElementById('bill_total');

        function formatCurrency(amount) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount).replace('₫', 'đ');
        }

        function calculateTotal() {
            const start = new Date(startDateInput.value);
            const end = new Date(endDateInput.value);

            if (startDateInput.value && endDateInput.value && end >= start) {
                // Tính số ngày (mili giây -> ngày)
                const diffTime = Math.abs(end - start);
                let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                
                // Nếu trả trong ngày thì tính là 1 ngày
                if (diffDays === 0) diffDays = 1;

                // Hiển thị info
                daysCountEl.innerText = diffDays;
                durationInfoEl.classList.remove('hidden');

                // Update Hóa đơn
                billDaysEl.innerText = diffDays;
                const total = diffDays * pricePerDay;
                
                billSubtotalEl.innerText = formatCurrency(total);
                billTotalEl.innerText = formatCurrency(total);
            } else {
                durationInfoEl.classList.add('hidden');
                // Reset về mặc định 1 ngày
                billDaysEl.innerText = '1';
                billSubtotalEl.innerText = formatCurrency(pricePerDay);
                billTotalEl.innerText = formatCurrency(pricePerDay);
            }
        }

        startDateInput.addEventListener('change', function() {
            // Tự động set ngày trả = ngày nhận nếu chưa chọn
            if (!endDateInput.value) {
                endDateInput.value = this.value;
            }
            // Validate: Ngày trả không được nhỏ hơn ngày nhận
            endDateInput.min = this.value;
            calculateTotal();
        });

        endDateInput.addEventListener('change', calculateTotal);
    });
</script>
@endsection