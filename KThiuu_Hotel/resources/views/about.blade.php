@extends('layouts.app')

@section('title', 'Giới thiệu')
@section('description', 'Tìm hiểu về KThiuu Hotel - Chuỗi khách sạn sang trọng với dịch vụ đẳng cấp và không gian tinh tế.')

@section('content')
<!-- Hero Section -->
<section class="relative h-[60vh] min-h-[500px] flex items-center">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');"></div>
    <div class="absolute inset-0 bg-green-900/70"></div>
    <div class="container-custom relative z-10 text-white text-center">
        <h1 class="text-5xl font-bold mb-4" style="font-family: 'Playfair Display', serif;">Về KThiuu Hotel</h1>
        <p class="text-xl text-gray-200 max-w-2xl mx-auto">Trải nghiệm nghỉ dưỡng đẳng cấp với không gian sang trọng, dịch vụ hoàn hảo và vị trí đắc địa.</p>
    </div>
</section>

<!-- Story Section -->
<section class="section">
    <div class="container-custom">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-amber-600 uppercase tracking-widest text-sm mb-4">Câu chuyện của chúng tôi</p>
                <h2 class="text-4xl font-bold mb-6" style="font-family: 'Playfair Display', serif;">
                    Hành trình kiến tạo<br>trải nghiệm đẳng cấp
                </h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    KThiuu Hotel được thành lập với sứ mệnh mang đến những trải nghiệm nghỉ dưỡng hoàn hảo, nơi mà sự sang trọng hòa quyện với sự ấm áp của lòng hiếu khách Việt Nam.
                </p>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Mỗi chi tiết tại KThiuu Hotel đều được chăm chút tỉ mỉ, từ kiến trúc hiện đại đến nội thất tinh tế, tạo nên không gian sống đẳng cấp cho quý khách.
                </p>
                <div class="flex gap-8">
                    <div>
                        <p class="text-4xl font-bold text-green-800">2020</p>
                        <p class="text-gray-500">Thành lập</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-green-800">50+</p>
                        <p class="text-gray-500">Phòng nghỉ</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-green-800">10K+</p>
                        <p class="text-gray-500">Khách hàng</p>
                    </div>
                </div>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80"
                    alt="KThiuu Hotel"
                    class="w-full h-[500px] object-cover">
                <div class="absolute -bottom-6 -right-6 bg-amber-500 p-8 max-w-xs">
                    <p class="text-lg font-semibold text-gray-900">"Sự hài lòng của khách hàng là thước đo thành công của chúng tôi."</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="section bg-white">
    <div class="container-custom">
        <div class="text-center mb-12">
            <h2 class="section-title">Giá trị cốt lõi</h2>
            <div class="gold-line"></div>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center p-8">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="heart" class="w-10 h-10 text-green-800"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4" style="font-family: 'Playfair Display', serif;">Tận tâm</h3>
                <p class="text-gray-600">Đặt sự hài lòng của khách hàng lên hàng đầu trong mọi dịch vụ.</p>
            </div>
            <div class="text-center p-8">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="award" class="w-10 h-10 text-green-800"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4" style="font-family: 'Playfair Display', serif;">Chất lượng</h3>
                <p class="text-gray-600">Cam kết mang đến dịch vụ và trải nghiệm đẳng cấp quốc tế.</p>
            </div>
            <div class="text-center p-8">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="sparkles" class="w-10 h-10 text-green-800"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4" style="font-family: 'Playfair Display', serif;">Sáng tạo</h3>
                <p class="text-gray-600">Không ngừng đổi mới để mang đến những trải nghiệm mới mẻ.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section section-dark">
    <div class="container-custom text-center">
        <h2 class="text-3xl font-bold mb-4" style="font-family: 'Playfair Display', serif;">Sẵn sàng trải nghiệm?</h2>
        <p class="text-gray-300 max-w-xl mx-auto mb-8">Đặt phòng ngay hôm nay để tận hưởng kỳ nghỉ đáng nhớ tại KThiuu Hotel.</p>
        <a href="{{ route('rooms.index') }}" class="btn-gold">Đặt phòng ngay</a>
    </div>
</section>
@endsection

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush