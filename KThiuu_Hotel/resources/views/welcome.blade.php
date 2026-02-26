@extends('layouts.app')

@section('title', 'Trang chủ')
@section('description', 'KThiuu Hotel - Chuỗi khách sạn sang trọng với dịch vụ đẳng cấp, không gian tinh tế và trải nghiệm nghỉ dưỡng hoàn hảo.')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');"></div>
    <div class="hero-overlay"></div>

    <div class="container-custom w-full">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Hero Content -->
            <div class="hero-content animate-fade-in-up">
                <p class="text-amber-400 uppercase tracking-widest text-sm mb-4">Chào mừng đến với</p>
                <h1 class="hero-title">KThiuu Hotel</h1>
                <p class="hero-subtitle">Trải nghiệm nghỉ dưỡng đẳng cấp với không gian sang trọng, dịch vụ hoàn hảo và vị trí đắc địa.</p>
                <div class="flex gap-4">
                    <a href="{{ route('rooms.index') }}" class="btn-gold">Khám phá ngay</a>
                    <a href="{{ route('about') }}" class="btn-secondary border-white text-white hover:bg-white hover:text-gray-900">Tìm hiểu thêm</a>
                </div>
            </div>

            <!-- Booking Widget -->
            <div class="booking-widget animate-fade-in-up delay-200">
                <h3 class="text-xl font-semibold mb-6" style="font-family: 'Playfair Display', serif;">Đặt phòng nhanh</h3>
                <form action="{{ route('rooms.index') }}" method="GET">
                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="booking-label">Ngày nhận phòng</label>
                            <input type="date" name="check_in" class="booking-input" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}">
                        </div>
                        <div>
                            <label class="booking-label">Ngày trả phòng</label>
                            <input type="date" name="check_out" class="booking-input" min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="booking-label">Số khách</label>
                            <select name="guests" class="booking-input">
                                <option value="1">1 Khách</option>
                                <option value="2" selected>2 Khách</option>
                                <option value="3">3 Khách</option>
                                <option value="4">4 Khách</option>
                            </select>
                        </div>
                        <div>
                            <label class="booking-label">Loại phòng</label>
                            <select name="type" class="booking-input">
                                <option value="">Tất cả</option>
                                <option value="luxury">Luxury</option>
                                <option value="grand">Grand</option>
                                <option value="holiday">Holiday</option>
                                <option value="standard">Standard</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn-primary w-full">Tìm phòng trống</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Room Types Section -->
<section class="section bg-white">
    <div class="container-custom">
        <h2 class="section-title">Loại phòng</h2>
        <div class="gold-line"></div>
        <p class="section-subtitle">Khám phá các loại phòng sang trọng được thiết kế tinh tế, mang đến trải nghiệm nghỉ dưỡng hoàn hảo.</p>

        <div class="room-types mb-12">
            <button class="room-type-tab active" data-type="all">Tất cả</button>
            @foreach($roomTypes ?? [] as $type)
            <button class="room-type-tab" data-type="{{ $type->slug }}">{{ $type->name }}</button>
            @endforeach
        </div>

        <!-- Featured Rooms Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($featuredRooms ?? [] as $room)
            <div class="room-card">
                <div class="room-card-image">
                    <img src="{{ $room->image ?? 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=1074&q=80' }}"
                        alt="{{ $room->name }}">
                    @if($room->roomType)
                    <span class="room-card-badge">{{ $room->roomType->name }}</span>
                    @endif
                </div>
                <div class="room-card-content">
                    <h3 class="room-card-title">{{ $room->name }}</h3>
                    <p class="text-gray-500 text-sm mb-4">
                        <span class="inline-flex items-center gap-1">
                            <i data-lucide="users" class="w-4 h-4"></i>
                            {{ $room->capacity ?? 2 }} Khách
                        </span>
                        <span class="mx-2">•</span>
                        <span class="inline-flex items-center gap-1">
                            <i data-lucide="maximize" class="w-4 h-4"></i>
                            {{ $room->area ?? 35 }}m²
                        </span>
                    </p>
                    <div class="flex items-center justify-between">
                        <p class="room-card-price">
                            {{ number_format($room->price ?? 1500000) }}đ <span>/ đêm</span>
                        </p>
                        <a href="{{ route('rooms.show', $room) }}" class="text-green-800 font-medium hover:underline">
                            Chi tiết →
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <!-- Demo rooms when no data -->
            @for($i = 0; $i < 6; $i++)
                <div class="room-card">
                <div class="room-card-image">
                    <img src="https://images.unsplash.com/photo-{{ collect(['1590490360182-c33d57733427', '1611892440504-42a792e24d32', '1582719478250-c89cae4dc85b', '1618773928121-c32242e63f39', '1631049307264-da0ec9d70304', '1595576508898-0ad5c879a061'])->random() }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=1074&q=80"
                        alt="Room {{ $i + 1 }}">
                    <span class="room-card-badge">{{ collect(['Luxury', 'Grand', 'Holiday'])->random() }}</span>
                </div>
                <div class="room-card-content">
                    <h3 class="room-card-title">{{ collect(['Deluxe Suite', 'Premium Room', 'Executive Suite', 'Grand Room', 'Family Suite', 'Ocean View'])->random() }}</h3>
                    <p class="text-gray-500 text-sm mb-4">
                        <span class="inline-flex items-center gap-1">
                            <i data-lucide="users" class="w-4 h-4"></i>
                            {{ rand(2, 4) }} Khách
                        </span>
                        <span class="mx-2">•</span>
                        <span class="inline-flex items-center gap-1">
                            <i data-lucide="maximize" class="w-4 h-4"></i>
                            {{ rand(30, 60) }}m²
                        </span>
                    </p>
                    <div class="flex items-center justify-between">
                        <p class="room-card-price">
                            {{ number_format(rand(15, 50) * 100000) }}đ <span>/ đêm</span>
                        </p>
                        <a href="{{ route('rooms.index') }}" class="text-green-800 font-medium hover:underline">
                            Chi tiết →
                        </a>
                    </div>
                </div>
        </div>
        @endfor
        @endforelse
    </div>

    <div class="text-center mt-12">
        <a href="{{ route('rooms.index') }}" class="btn-secondary">Xem tất cả phòng</a>
    </div>
    </div>
</section>

<!-- Services Section -->
<section class="section bg-cream">
    <div class="container-custom">
        <h2 class="section-title">Dịch vụ của chúng tôi</h2>
        <div class="gold-line"></div>
        <p class="section-subtitle">Tận hưởng các dịch vụ cao cấp được thiết kế để mang đến sự thoải mái và tiện nghi tối đa.</p>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($services ?? [] as $service)
            <div class="service-card">
                <div class="service-icon">
                    <i data-lucide="{{ $service->icon ?? 'star' }}"></i>
                </div>
                <h3 class="service-title">{{ $service->name }}</h3>
                <p class="service-description">{{ $service->description }}</p>
            </div>
            @empty
            <div class="service-card">
                <div class="service-icon">
                    <i data-lucide="utensils"></i>
                </div>
                <h3 class="service-title">Nhà hàng & Bar</h3>
                <p class="service-description">Thưởng thức ẩm thực đa dạng với không gian sang trọng và phục vụ chu đáo.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">
                    <i data-lucide="waves"></i>
                </div>
                <h3 class="service-title">Hồ bơi & Spa</h3>
                <p class="service-description">Thư giãn tại hồ bơi ngoài trời hoặc trải nghiệm liệu pháp spa đẳng cấp.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">
                    <i data-lucide="users"></i>
                </div>
                <h3 class="service-title">Hội họp & Sự kiện</h3>
                <p class="service-description">Không gian hội nghị hiện đại với trang thiết bị tiên tiến.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">
                    <i data-lucide="car"></i>
                </div>
                <h3 class="service-title">Đưa đón sân bay</h3>
                <p class="service-description">Dịch vụ đưa đón VIP với xe sang trọng và tài xế chuyên nghiệp.</p>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('services.index') }}" class="btn-secondary">Xem tất cả dịch vụ</a>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="section section-dark">
    <div class="container-custom">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-amber-400 uppercase tracking-widest text-sm mb-4">Về chúng tôi</p>
                <h2 class="text-4xl font-bold mb-6" style="font-family: 'Playfair Display', serif;">
                    Trải nghiệm đẳng cấp<br>tại KThiuu Hotel
                </h2>
                <p class="text-gray-300 mb-6 leading-relaxed">
                    Với cam kết mang đến những trải nghiệm nghỉ dưỡng hoàn hảo, KThiuu Hotel tự hào là điểm đến lý tưởng cho những ai tìm kiếm sự sang trọng, tiện nghi và dịch vụ chu đáo.
                </p>
                <p class="text-gray-300 mb-8 leading-relaxed">
                    Mỗi chi tiết tại KThiuu Hotel đều được chăm chút tỉ mỉ, từ kiến trúc hiện đại đến nội thất tinh tế, tạo nên không gian sống đẳng cấp cho quý khách.
                </p>
                <div class="flex gap-8 mb-8">
                    <div class="text-center">
                        <p class="text-4xl font-bold text-amber-400">50+</p>
                        <p class="text-gray-400 text-sm uppercase tracking-wider">Phòng nghỉ</p>
                    </div>
                    <div class="text-center">
                        <p class="text-4xl font-bold text-amber-400">10K+</p>
                        <p class="text-gray-400 text-sm uppercase tracking-wider">Khách hàng</p>
                    </div>
                    <div class="text-center">
                        <p class="text-4xl font-bold text-amber-400">4.9</p>
                        <p class="text-gray-400 text-sm uppercase tracking-wider">Đánh giá</p>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="btn-gold">Tìm hiểu thêm</a>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80"
                    alt="KThiuu Hotel"
                    class="w-full h-[500px] object-cover">
                <div class="absolute -bottom-6 -left-6 bg-amber-500 p-6 max-w-xs">
                    <p class="text-lg font-semibold text-gray-900">Đặt phòng ngay hôm nay</p>
                    <p class="text-gray-800">Giảm 20% cho đặt phòng sớm!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="section bg-white">
    <div class="container-custom">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="section-title">Đăng ký nhận ưu đãi</h2>
            <div class="gold-line"></div>
            <p class="section-subtitle">Đăng ký để nhận thông tin về các chương trình khuyến mãi và ưu đãi đặc biệt từ KThiuu Hotel.</p>

            <form class="flex gap-4 max-w-xl mx-auto">
                <input type="email" placeholder="Nhập email của bạn" class="flex-1 booking-input">
                <button type="submit" class="btn-primary whitespace-nowrap">Đăng ký</button>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Reinitialize icons after dynamic content
    lucide.createIcons();
</script>
@endpush