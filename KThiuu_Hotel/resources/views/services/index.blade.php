@extends('layouts.app')

@section('title', 'Dịch vụ')
@section('description', 'Khám phá các dịch vụ cao cấp tại KThiuu Hotel - Nhà hàng, Spa, Hội nghị và nhiều hơn nữa.')

@section('content')
<!-- Page Header -->
<section class="bg-green-900 py-20">
    <div class="container-custom text-center text-white">
        <h1 class="text-4xl font-bold mb-4" style="font-family: 'Playfair Display', serif;">Dịch vụ</h1>
        <p class="text-gray-300 max-w-xl mx-auto">Tận hưởng các dịch vụ cao cấp được thiết kế để mang đến sự thoải mái và tiện nghi tối đa cho quý khách.</p>
    </div>
</section>

<section class="section">
    <div class="container-custom">
        <!-- Services Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($services as $service)
            <div class="bg-white border border-gray-100 overflow-hidden group">
                <div class="h-56 overflow-hidden">
                    <img src="{{ $service->image ?? 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}"
                        alt="{{ $service->name }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>
                <div class="p-6">
                    <div class="w-16 h-16 bg-green-800 flex items-center justify-center text-white -mt-14 mb-4 relative z-10">
                        <i data-lucide="{{ $service->icon ?? 'star' }}" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3" style="font-family: 'Playfair Display', serif;">{{ $service->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ $service->description }}</p>
                    <a href="{{ route('services.show', $service) }}" class="text-green-800 font-medium hover:underline">
                        Tìm hiểu thêm →
                    </a>
                </div>
            </div>
            @empty
            <!-- Demo services -->
            @php
            $demoServices = [
            ['icon' => 'utensils', 'name' => 'Nhà hàng & Bar', 'desc' => 'Thưởng thức ẩm thực đa dạng từ các đầu bếp hàng đầu trong không gian sang trọng.', 'img' => 'photo-1414235077428-338989a2e8c0'],
            ['icon' => 'waves', 'name' => 'Hồ bơi & Spa', 'desc' => 'Thư giãn tại hồ bơi ngoài trời hoặc trải nghiệm liệu pháp spa đẳng cấp.', 'img' => 'photo-1540555700478-4be289fbec6b'],
            ['icon' => 'users', 'name' => 'Hội nghị & Sự kiện', 'desc' => 'Không gian hội nghị hiện đại với sức chứa lên đến 500 khách.', 'img' => 'photo-1505373877841-8d25f7d46678'],
            ['icon' => 'dumbbell', 'name' => 'Phòng Gym', 'desc' => 'Phòng tập thể dục với trang thiết bị hiện đại, mở cửa 24/7.', 'img' => 'photo-1534438327276-14e5300c3a48'],
            ['icon' => 'car', 'name' => 'Đưa đón VIP', 'desc' => 'Dịch vụ đưa đón sân bay với xe sang trọng và tài xế chuyên nghiệp.', 'img' => 'photo-1449965408869-eaa3f722e40d'],
            ['icon' => 'baby', 'name' => 'Dịch vụ Gia đình', 'desc' => 'Khu vui chơi trẻ em, dịch vụ trông trẻ và các tiện ích dành cho gia đình.', 'img' => 'photo-1596394516093-501ba68a0ba6'],
            ];
            @endphp
            @foreach($demoServices as $service)
            <div class="bg-white border border-gray-100 overflow-hidden group">
                <div class="h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/{{ $service['img'] }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="{{ $service['name'] }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>
                <div class="p-6">
                    <div class="w-16 h-16 bg-green-800 flex items-center justify-center text-white -mt-14 mb-4 relative z-10">
                        <i data-lucide="{{ $service['icon'] }}" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3" style="font-family: 'Playfair Display', serif;">{{ $service['name'] }}</h3>
                    <p class="text-gray-600 mb-4">{{ $service['desc'] }}</p>
                    <a href="#" class="text-green-800 font-medium hover:underline">
                        Tìm hiểu thêm →
                    </a>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section section-dark">
    <div class="container-custom text-center">
        <h2 class="text-3xl font-bold mb-4" style="font-family: 'Playfair Display', serif;">Cần hỗ trợ?</h2>
        <p class="text-gray-300 max-w-xl mx-auto mb-8">Liên hệ với chúng tôi để được tư vấn và đặt dịch vụ theo yêu cầu.</p>
        <div class="flex justify-center gap-4 flex-wrap">
            <a href="tel:19001833" class="btn-gold">
                <i data-lucide="phone" class="w-5 h-5 inline mr-2"></i>
                1900 1833
            </a>
            <a href="{{ route('contact') }}" class="btn-secondary border-white text-white hover:bg-white hover:text-gray-900">
                Liên hệ ngay
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush