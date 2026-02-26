@extends('layouts.app')

@section('title', 'Xác nhận đặt phòng')
@section('description', 'Xác nhận thông tin đặt phòng tại KThiuu Hotel')

@section('content')
<!-- Page Header -->
<section class="bg-green-900 py-16">
    <div class="container-custom">
        <nav class="text-gray-300 text-sm mb-4">
            <a href="{{ route('home') }}" class="hover:text-white">Trang chủ</a> /
            <a href="{{ route('rooms.index') }}" class="hover:text-white">Phòng</a> /
            <a href="{{ route('rooms.show', $room) }}" class="hover:text-white">{{ $room->name }}</a> /
            <span class="text-white">Đặt phòng</span>
        </nav>
        <h1 class="text-3xl font-bold text-white" style="font-family: 'Playfair Display', serif;">Xác nhận đặt phòng</h1>
    </div>
</section>

<section class="section">
    <div class="container-custom">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Booking Form -->
            <div class="lg:col-span-2">
                <form action="{{ route('bookings.store') }}" method="POST" class="bg-white p-8 border border-gray-100">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <input type="hidden" name="check_in" value="{{ $checkIn }}">
                    <input type="hidden" name="check_out" value="{{ $checkOut }}">

                    <h2 class="text-2xl font-semibold mb-6" style="font-family: 'Playfair Display', serif;">Thông tin khách hàng</h2>

                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="form-label">Họ và tên</label>
                            <input type="text" class="form-input bg-gray-50" value="{{ auth()->user()->name }}" readonly>
                        </div>
                        <div>
                            <label class="form-label">Email</label>
                            <input type="email" class="form-input bg-gray-50" value="{{ auth()->user()->email }}" readonly>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="form-label">Yêu cầu đặc biệt (không bắt buộc)</label>
                        <textarea name="special_requests" rows="3" class="form-input" placeholder="Ví dụ: Cần phòng không hút thuốc, giường phụ cho trẻ em..."></textarea>
                    </div>

                    <h2 class="text-2xl font-semibold mb-6" style="font-family: 'Playfair Display', serif;">Phương thức thanh toán</h2>

                    <div class="space-y-4 mb-8">
                        <label class="flex items-center p-4 border border-gray-200 cursor-pointer hover:border-green-600 transition-colors">
                            <input type="radio" name="payment_method" value="vnpay" class="w-5 h-5 text-green-600" checked>
                            <div class="ml-4 flex-1">
                                <p class="font-semibold">Thanh toán qua VNPay</p>
                                <p class="text-sm text-gray-500">Thẻ ATM, Visa, MasterCard, QR Code</p>
                            </div>
                            <img src="https://vnpay.vn/s1/statics.vnpay.vn/2023/9/06ncktiwd6dc1694418196384.png" alt="VNPay" class="h-8">
                        </label>

                        <label class="flex items-center p-4 border border-gray-200 cursor-pointer hover:border-green-600 transition-colors">
                            <input type="radio" name="payment_method" value="cod" class="w-5 h-5 text-green-600">
                            <div class="ml-4 flex-1">
                                <p class="font-semibold">Thanh toán tại khách sạn</p>
                                <p class="text-sm text-gray-500">Thanh toán khi nhận phòng bằng tiền mặt hoặc thẻ</p>
                            </div>
                            <i data-lucide="wallet" class="w-8 h-8 text-gray-400"></i>
                        </label>
                    </div>

                    <div class="bg-amber-50 border border-amber-200 p-4 mb-6">
                        <h3 class="font-semibold text-amber-800 mb-2 flex items-center gap-2">
                            <i data-lucide="info" class="w-5 h-5"></i>
                            Chính sách hủy phòng
                        </h3>
                        <ul class="text-sm text-amber-700 list-disc list-inside">
                            <li>Hủy miễn phí trước 24 giờ nhận phòng</li>
                            <li>Hủy sau 24 giờ: Phí 50% tổng giá trị đặt phòng</li>
                            <li>Không hoàn tiền nếu không đến (no-show)</li>
                        </ul>
                    </div>

                    <button type="submit" class="btn-gold w-full text-lg py-4">
                        Xác nhận đặt phòng
                    </button>
                </form>
            </div>

            <!-- Booking Summary -->
            <div class="lg:col-span-1">
                <div class="booking-widget sticky top-28">
                    <h3 class="text-xl font-semibold mb-6" style="font-family: 'Playfair Display', serif;">Thông tin đặt phòng</h3>

                    <div class="mb-6">
                        <img src="{{ $room->image ?? 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}"
                            alt="{{ $room->name }}"
                            class="w-full h-40 object-cover mb-4">
                        <h4 class="font-semibold text-lg">{{ $room->name }}</h4>
                        @if($room->roomType)
                        <p class="text-sm text-amber-600">{{ $room->roomType->name }}</p>
                        @endif
                    </div>

                    <div class="space-y-3 mb-6 pb-6 border-b">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Nhận phòng</span>
                            <span class="font-semibold">{{ \Carbon\Carbon::parse($checkIn)->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Trả phòng</span>
                            <span class="font-semibold">{{ \Carbon\Carbon::parse($checkOut)->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Số đêm</span>
                            <span class="font-semibold">{{ $nights }} đêm</span>
                        </div>
                    </div>

                    <div class="space-y-3 mb-6 pb-6 border-b">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Giá phòng x {{ $nights }} đêm</span>
                            <span>{{ number_format($room->price * $nights) }}đ</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Thuế & phí dịch vụ</span>
                            <span class="text-green-600">Miễn phí</span>
                        </div>
                    </div>

                    <div class="flex justify-between text-xl font-bold">
                        <span>Tổng cộng</span>
                        <span class="text-green-800">{{ number_format($totalPrice) }}đ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush