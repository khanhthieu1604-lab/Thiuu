@extends('layouts.app')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
    
    <div class="relative h-[400px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?q=80&w=2070&auto=format&fit=crop" 
                 class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-blue-900/30"></div>
        </div>
        <div class="relative z-10 text-center px-4">
            <span class="text-yellow-500 font-bold tracking-[0.3em] text-xs uppercase mb-3 block animate-pulse">Premium Services</span>
            <h1 class="text-4xl md:text-5xl font-heading font-bold text-white mb-4 uppercase tracking-wide drop-shadow-2xl">
                Giải Pháp Di Chuyển <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">Toàn Diện</span>
            </h1>
            <p class="text-gray-300 text-sm max-w-xl mx-auto font-light">
                Đáp ứng mọi nhu cầu từ cá nhân đến doanh nghiệp với chất lượng 5 sao.
            </p>
        </div>
    </div>

    <section class="container mx-auto px-4 py-20 -mt-20 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="group bg-white dark:bg-gray-800 p-8 rounded-xl shadow-xl border-t-4 border-yellow-500 hover:transform hover:-translate-y-2 transition duration-300">
                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-6 text-yellow-500 text-3xl group-hover:bg-yellow-500 group-hover:text-white transition">
                    <i class="fa-solid fa-steering-wheel"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-3 uppercase">Thuê Xe Tự Lái</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-6">
                    Tự do khám phá hành trình của riêng bạn. Thủ tục đơn giản chỉ cần CCCD & GPLX. Giao xe tận nhà.
                </p>
                <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-2 mb-6">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Bảo hiểm 2 chiều</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Không giới hạn km</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Xe đời mới 2023+</li>
                </ul>
                <a href="{{ route('vehicles.index', ['category' => 'Sedan']) }}" class="inline-block w-full text-center py-3 rounded border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-white font-bold text-xs uppercase hover:bg-yellow-500 hover:border-yellow-500 hover:text-white transition">
                    Xem xe ngay
                </a>
            </div>

            <div class="group bg-white dark:bg-gray-800 p-8 rounded-xl shadow-xl border-t-4 border-blue-600 hover:transform hover:-translate-y-2 transition duration-300">
                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-6 text-blue-600 text-3xl group-hover:bg-blue-600 group-hover:text-white transition">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-3 uppercase">Thuê Xe Có Tài Xế</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-6">
                    Tận hưởng chuyến đi thư giãn với đội ngũ tài xế chuyên nghiệp, thông thạo đường xá, phục vụ tận tâm.
                </p>
                <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-2 mb-6">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-blue-500"></i> Tài xế Tiếng Anh/Trung</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-blue-500"></i> Đưa đón đúng giờ</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-blue-500"></i> Nước suối & Wifi free</li>
                </ul>
                <a href="https://visafe.com.vn/" class="inline-block w-full text-center py-3 rounded border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-white font-bold text-xs uppercase hover:bg-blue-600 hover:border-blue-600 hover:text-white transition">
                    Liên hệ tài xế
                </a>
            </div>

            <div class="group bg-white dark:bg-gray-800 p-8 rounded-xl shadow-xl border-t-4 border-pink-500 hover:transform hover:-translate-y-2 transition duration-300">
                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-6 text-pink-500 text-3xl group-hover:bg-pink-500 group-hover:text-white transition">
                    <i class="fa-solid fa-gem"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-3 uppercase">Xe Hoa & Sự Kiện</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-6">
                    Dàn siêu xe, xe sang (Mercedes, BMW, Porsche...) phục vụ đám cưới, sự kiện, quay phim quảng cáo.
                </p>
                <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-2 mb-6">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-pink-500"></i> Trang trí hoa tươi</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-pink-500"></i> Đội hình đồng bộ</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-pink-500"></i> Giá ưu đãi trọn gói</li>
                </ul>
                <a href="#" class="inline-block w-full text-center py-3 rounded border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-white font-bold text-xs uppercase hover:bg-pink-500 hover:border-pink-500 hover:text-white transition">
                    Tư vấn ngay
                </a>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-12 shadow-lg border border-gray-100 dark:border-gray-700">
            <div>
                <span class="text-yellow-500 font-bold uppercase tracking-widest text-xs mb-2 block">Dành cho doanh nghiệp</span>
                <h2 class="text-3xl font-heading font-bold text-gray-900 dark:text-white mb-4">Thuê Xe Tháng & Dài Hạn</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-6 text-justify">
                    Thiuu Rental cung cấp giải pháp thuê xe tháng cho các doanh nghiệp nước ngoài, văn phòng đại diện với hợp đồng minh bạch, xuất hóa đơn VAT đầy đủ và chiết khấu hấp dẫn lên đến 20% cho hợp đồng trên 1 năm.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="bg-blue-900 hover:bg-blue-800 text-white px-6 py-3 rounded font-bold text-xs uppercase shadow-lg transition">
                        Nhận báo giá
                    </a>
                    <a href="tel:0909123456" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 font-bold text-sm hover:text-yellow-500 transition">
                        <i class="fa-solid fa-phone"></i> 0909.123.456
                    </a>
                </div>
            </div>
            <div class="relative h-64 md:h-full overflow-hidden rounded-xl">
                <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=2070&auto=format&fit=crop" 
                     class="absolute inset-0 w-full h-full object-cover transform hover:scale-105 transition duration-700">
            </div>
        </div>
    </section>

    <section class="bg-gray-100 dark:bg-black/20 py-16 border-t border-gray-200 dark:border-gray-800">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-10 font-heading uppercase tracking-wide">Quy trình đặt xe</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="relative">
                    <div class="w-14 h-14 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center text-gray-900 dark:text-white text-xl font-bold border-2 border-yellow-500 mx-auto mb-4 z-10 relative">1</div>
                    <h4 class="font-bold text-gray-800 dark:text-gray-200 text-sm uppercase mb-2">Chọn xe</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Tham khảo mẫu xe & giá trên website</p>
                </div>
                <div class="relative">
                    <div class="w-14 h-14 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center text-gray-900 dark:text-white text-xl font-bold border-2 border-gray-300 dark:border-gray-600 mx-auto mb-4 z-10 relative">2</div>
                    <h4 class="font-bold text-gray-800 dark:text-gray-200 text-sm uppercase mb-2">Đặt cọc</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Chốt lịch và chuyển cọc giữ xe</p>
                </div>
                <div class="relative">
                    <div class="w-14 h-14 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center text-gray-900 dark:text-white text-xl font-bold border-2 border-gray-300 dark:border-gray-600 mx-auto mb-4 z-10 relative">3</div>
                    <h4 class="font-bold text-gray-800 dark:text-gray-200 text-sm uppercase mb-2">Nhận xe</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Giao xe tận nơi & ký hợp đồng</p>
                </div>
                <div class="relative">
                    <div class="w-14 h-14 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center text-gray-900 dark:text-white text-xl font-bold border-2 border-gray-300 dark:border-gray-600 mx-auto mb-4 z-10 relative">4</div>
                    <h4 class="font-bold text-gray-800 dark:text-gray-200 text-sm uppercase mb-2">Hoàn tất</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Trả xe và thanh toán phần còn lại</p>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection