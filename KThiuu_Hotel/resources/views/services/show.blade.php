@extends('layouts.app')

@section('title', $service->name)
@section('description', $service->description ?? 'Dịch vụ ' . $service->name . ' tại KThiuu Hotel.')

@section('content')
<!-- Page Header -->
<section class="bg-green-900 py-20">
    <div class="container-custom">
        <nav class="text-gray-300 text-sm mb-4">
            <a href="{{ route('home') }}" class="hover:text-white">Trang chủ</a> /
            <a href="{{ route('services.index') }}" class="hover:text-white">Dịch vụ</a> /
            <span class="text-white">{{ $service->name }}</span>
        </nav>
        <h1 class="text-4xl font-bold text-white" style="font-family: 'Playfair Display', serif;">{{ $service->name }}</h1>
    </div>
</section>

<section class="section">
    <div class="container-custom">
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <img src="{{ $service->image ?? 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80' }}"
                    alt="{{ $service->name }}"
                    class="w-full h-[400px] object-cover mb-8">

                <div class="prose max-w-none">
                    <p class="text-xl text-gray-600 mb-6">{{ $service->description }}</p>

                    @if($service->content)
                    {!! $service->content !!}
                    @else
                    <h3>Giới thiệu</h3>
                    <p>{{ $service->name }} tại KThiuu Hotel mang đến trải nghiệm đẳng cấp với đội ngũ nhân viên chuyên nghiệp và trang thiết bị hiện đại.</p>

                    <h3>Tiện ích</h3>
                    <ul>
                        <li>Phục vụ 24/7</li>
                        <li>Đội ngũ chuyên nghiệp</li>
                        <li>Trang thiết bị hiện đại</li>
                        <li>Không gian sang trọng</li>
                    </ul>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="booking-widget">
                    <h3 class="text-xl font-semibold mb-6" style="font-family: 'Playfair Display', serif;">Đặt dịch vụ</h3>
                    <p class="text-gray-600 mb-6">Liên hệ với chúng tôi để đặt dịch vụ hoặc nhận tư vấn.</p>

                    <a href="tel:19001833" class="btn-gold w-full block text-center mb-4">
                        <i data-lucide="phone" class="w-5 h-5 inline mr-2"></i>
                        1900 1833
                    </a>
                    <a href="{{ route('contact') }}" class="btn-secondary w-full block text-center">
                        Gửi yêu cầu
                    </a>
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