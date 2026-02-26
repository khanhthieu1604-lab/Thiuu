@extends('layouts.app')

@section('title', $room->name)
@section('description', $room->description ?? 'Phòng ' . $room->name . ' tại KThiuu Hotel với đầy đủ tiện nghi cao cấp.')

@section('content')
<!-- Page Header -->
<section class="bg-green-900 py-20">
    <div class="container-custom">
        <nav class="text-gray-300 text-sm mb-4">
            <a href="{{ route('home') }}" class="hover:text-white">Trang chủ</a> /
            <a href="{{ route('rooms.index') }}" class="hover:text-white">Phòng</a> /
            <span class="text-white">{{ $room->name }}</span>
        </nav>
        <h1 class="text-4xl font-bold text-white" style="font-family: 'Playfair Display', serif;">{{ $room->name }}</h1>
    </div>
</section>

<section class="section">
    <div class="container-custom">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Image Gallery -->
                <div class="mb-8">
                    <img src="{{ $room->image ?? 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=1074&q=80' }}"
                        alt="{{ $room->name }}"
                        class="w-full h-[500px] object-cover">
                </div>

                <!-- Room Info -->
                <div class="bg-white p-8 border border-gray-100 mb-8">
                    <div class="flex items-center gap-6 mb-6 pb-6 border-b">
                        @if($room->roomType)
                        <span class="bg-amber-500 text-gray-900 px-4 py-2 font-semibold text-sm uppercase">
                            {{ $room->roomType->name }}
                        </span>
                        @endif
                        <span class="flex items-center gap-2 text-gray-600">
                            <i data-lucide="users" class="w-5 h-5"></i>
                            {{ $room->capacity ?? 2 }} Khách
                        </span>
                        <span class="flex items-center gap-2 text-gray-600">
                            <i data-lucide="maximize" class="w-5 h-5"></i>
                            {{ $room->area ?? 35 }}m²
                        </span>
                        <span class="flex items-center gap-2 text-gray-600">
                            <i data-lucide="bed-double" class="w-5 h-5"></i>
                            {{ $room->bed_type ?? '1 Giường đôi' }}
                        </span>
                    </div>

                    <h2 class="text-2xl font-semibold mb-4" style="font-family: 'Playfair Display', serif;">Mô tả</h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        {{ $room->description ?? 'Phòng được thiết kế sang trọng với nội thất hiện đại, mang đến không gian nghỉ ngơi thoải mái và đẳng cấp. Tầm nhìn tuyệt đẹp ra thành phố cùng đầy đủ tiện nghi cao cấp sẽ làm hài lòng mọi vị khách.' }}
                    </p>

                    <h3 class="text-xl font-semibold mb-4" style="font-family: 'Playfair Display', serif;">Tiện nghi</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @forelse($room->amenities as $amenity)
                        <div class="amenity-item">
                            <i data-lucide="{{ $amenity->icon ?? 'check' }}" class="amenity-icon w-5 h-5"></i>
                            <span>{{ $amenity->name }}</span>
                        </div>
                        @empty
                        @foreach(['wifi' => 'Wifi miễn phí', 'tv' => 'Smart TV', 'snowflake' => 'Điều hòa', 'coffee' => 'Mini bar', 'bath' => 'Bồn tắm', 'vault' => 'Két an toàn'] as $icon => $name)
                        <div class="amenity-item">
                            <i data-lucide="{{ $icon }}" class="amenity-icon w-5 h-5"></i>
                            <span>{{ $name }}</span>
                        </div>
                        @endforeach
                        @endforelse
                    </div>
                </div>

                <!-- Policies -->
                <div class="bg-white p-8 border border-gray-100">
                    <h3 class="text-xl font-semibold mb-4" style="font-family: 'Playfair Display', serif;">Chính sách</h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="clock" class="w-5 h-5 text-green-800"></i>
                                Giờ nhận/trả phòng
                            </h4>
                            <p class="text-gray-600">Nhận phòng: 14:00</p>
                            <p class="text-gray-600">Trả phòng: 12:00</p>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="ban" class="w-5 h-5 text-green-800"></i>
                                Hủy đặt phòng
                            </h4>
                            <p class="text-gray-600">Miễn phí hủy trước 24h</p>
                            <p class="text-gray-600">Phí 50% nếu hủy sau</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Booking -->
            <div class="lg:col-span-1">
                <div class="booking-widget sticky top-28">
                    <div class="text-center mb-6">
                        <p class="text-gray-500 text-sm mb-1">Giá chỉ từ</p>
                        <p class="text-3xl font-bold text-green-800">{{ number_format($room->price ?? 2000000) }}đ</p>
                        <p class="text-gray-500 text-sm">/ đêm</p>
                    </div>

                    @auth
                    <form action="{{ route('bookings.create', $room) }}" method="GET">
                        <div class="space-y-4 mb-6">
                            <div>
                                <label class="booking-label">Ngày nhận phòng</label>
                                <input type="date" name="check_in" class="booking-input" required min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}">
                            </div>
                            <div>
                                <label class="booking-label">Ngày trả phòng</label>
                                <input type="date" name="check_out" class="booking-input" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ date('Y-m-d', strtotime('+1 day')) }}">
                            </div>
                            <div>
                                <label class="booking-label">Số khách</label>
                                <select name="guests" class="booking-input">
                                    @for($i = 1; $i <= ($room->capacity ?? 2); $i++)
                                        <option value="{{ $i }}">{{ $i }} Khách</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn-gold w-full">Đặt phòng ngay</button>
                    </form>
                    @else
                    <p class="text-center text-gray-500 mb-4">Vui lòng đăng nhập để đặt phòng</p>
                    <a href="{{ route('login') }}" class="btn-primary w-full block text-center">Đăng nhập</a>
                    @endauth

                    <div class="mt-6 pt-6 border-t">
                        <p class="text-sm text-gray-500 text-center">
                            <i data-lucide="phone" class="w-4 h-4 inline"></i>
                            Hotline: <a href="tel:19001833" class="text-green-800 font-semibold">1900 1833</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Rooms -->
        @if($relatedRooms->count() > 0)
        <div class="mt-16">
            <h2 class="section-title text-left mb-8">Phòng tương tự</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($relatedRooms as $relatedRoom)
                <div class="room-card">
                    <div class="room-card-image h-48">
                        <img src="{{ $relatedRoom->image ?? 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=1074&q=80' }}"
                            alt="{{ $relatedRoom->name }}">
                    </div>
                    <div class="room-card-content">
                        <h3 class="room-card-title text-lg">{{ $relatedRoom->name }}</h3>
                        <div class="flex items-center justify-between mt-4">
                            <p class="room-card-price text-lg">{{ number_format($relatedRoom->price) }}đ</p>
                            <a href="{{ route('rooms.show', $relatedRoom) }}" class="text-green-800 hover:underline">Xem →</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush