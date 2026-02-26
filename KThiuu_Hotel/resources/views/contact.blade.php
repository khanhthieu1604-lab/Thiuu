@extends('layouts.app')

@section('title', 'Liên hệ')
@section('description', 'Liên hệ với KThiuu Hotel để được hỗ trợ đặt phòng và tư vấn dịch vụ.')

@section('content')
<!-- Page Header -->
<section class="bg-green-900 py-20">
    <div class="container-custom text-center text-white">
        <h1 class="text-4xl font-bold mb-4" style="font-family: 'Playfair Display', serif;">Liên hệ</h1>
        <p class="text-gray-300 max-w-xl mx-auto">Chúng tôi luôn sẵn sàng hỗ trợ bạn. Hãy liên hệ với chúng tôi qua các kênh dưới đây.</p>
    </div>
</section>

<section class="section">
    <div class="container-custom">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Contact Info -->
            <div class="lg:col-span-1">
                <div class="bg-green-900 text-white p-8 h-full">
                    <h2 class="text-2xl font-semibold mb-8" style="font-family: 'Playfair Display', serif;">Thông tin liên hệ</h2>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-amber-500 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="map-pin" class="w-6 h-6 text-gray-900"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Địa chỉ</h3>
                                <p class="text-gray-300">123 Đường ABC, Quận 1,<br>TP. Hồ Chí Minh, Việt Nam</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-amber-500 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="phone" class="w-6 h-6 text-gray-900"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Điện thoại</h3>
                                <p class="text-gray-300">Hotline: <a href="tel:19001833" class="hover:text-amber-400">1900 1833</a></p>
                                <p class="text-gray-300">Tel: <a href="tel:+842812345678" class="hover:text-amber-400">+84 28 1234 5678</a></p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-amber-500 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="mail" class="w-6 h-6 text-gray-900"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Email</h3>
                                <p class="text-gray-300"><a href="mailto:contact@kthiuu-hotel.com" class="hover:text-amber-400">contact@kthiuu-hotel.com</a></p>
                                <p class="text-gray-300"><a href="mailto:booking@kthiuu-hotel.com" class="hover:text-amber-400">booking@kthiuu-hotel.com</a></p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-amber-500 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="clock" class="w-6 h-6 text-gray-900"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Giờ làm việc</h3>
                                <p class="text-gray-300">24/7 - Luôn sẵn sàng phục vụ</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-8 border-t border-gray-700">
                        <h3 class="font-semibold mb-4">Theo dõi chúng tôi</h3>
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 border border-gray-600 flex items-center justify-center hover:border-amber-500 hover:text-amber-500 transition-colors">
                                <i data-lucide="facebook" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="w-10 h-10 border border-gray-600 flex items-center justify-center hover:border-amber-500 hover:text-amber-500 transition-colors">
                                <i data-lucide="instagram" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="w-10 h-10 border border-gray-600 flex items-center justify-center hover:border-amber-500 hover:text-amber-500 transition-colors">
                                <i data-lucide="youtube" class="w-5 h-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-2">
                <div class="bg-white p-8 border border-gray-100">
                    <h2 class="text-2xl font-semibold mb-8" style="font-family: 'Playfair Display', serif;">Gửi tin nhắn</h2>

                    <form action="#" method="POST">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="form-label">Họ và tên *</label>
                                <input type="text" name="name" class="form-input" required placeholder="Nhập họ và tên">
                            </div>
                            <div>
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-input" required placeholder="Nhập email">
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="form-label">Số điện thoại</label>
                                <input type="tel" name="phone" class="form-input" placeholder="Nhập số điện thoại">
                            </div>
                            <div>
                                <label class="form-label">Chủ đề</label>
                                <select name="subject" class="form-input">
                                    <option value="">Chọn chủ đề</option>
                                    <option value="booking">Đặt phòng</option>
                                    <option value="service">Dịch vụ</option>
                                    <option value="event">Sự kiện</option>
                                    <option value="feedback">Góp ý</option>
                                    <option value="other">Khác</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="form-label">Nội dung *</label>
                            <textarea name="message" rows="5" class="form-input" required placeholder="Nhập nội dung tin nhắn..."></textarea>
                        </div>

                        <button type="submit" class="btn-primary">
                            Gửi tin nhắn
                            <i data-lucide="send" class="w-5 h-5 inline ml-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="mt-12">
            <div class="bg-gray-200 h-[400px] flex items-center justify-center">
                <div class="text-center">
                    <i data-lucide="map" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
                    <p class="text-gray-500">Bản đồ Google Maps sẽ được hiển thị ở đây</p>
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