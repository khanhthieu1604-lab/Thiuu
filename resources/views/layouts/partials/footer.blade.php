    <footer class="bg-gray-900 dark:bg-black text-gray-400 py-10 border-t-4 border-yellow-500 font-sans text-sm transition-colors duration-300">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                {{-- Cột 1: Thương hiệu & Liên hệ (Gộp lại cho gọn) --}}
                <div class="space-y-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 group">
                        <span class="text-2xl font-bold text-white uppercase tracking-wider group-hover:text-yellow-500 transition">Thiuu<span class="text-yellow-500 group-hover:text-white">Rental</span></span>
                    </a>
                    <div class="space-y-2 text-gray-500 text-xs">
                        <p class="flex items-center gap-2"><i class="fa-solid fa-location-dot text-yellow-500 w-4"></i> 123 Nguyễn Huệ, Quận 1, TP.HCM</p>
                        <p class="flex items-center gap-2"><i class="fa-solid fa-phone text-yellow-500 w-4"></i> <span class="text-white font-bold">0909.123.456</span></p>
                        <p class="flex items-center gap-2"><i class="fa-solid fa-envelope text-yellow-500 w-4"></i> support@thiuu.vn</p>
                    </div>
                </div>

                {{-- Cột 2: Menu nhanh (Chia 2 cột nhỏ bên trong) --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h4 class="text-white font-bold uppercase mb-3 text-xs tracking-widest">Dịch vụ</h4>
                        <ul class="space-y-2 text-xs">
                            <li><a href="{{ route('home') }}" class="hover:text-yellow-500 transition">Trang chủ</a></li>
                            <li><a href="{{ route('vehicles.index') }}" class="hover:text-yellow-500 transition">Thuê xe tự lái</a></li>
                            <li><a href="#" class="hover:text-yellow-500 transition">Xe có tài xế</a></li>
                            <li><a href="#" class="hover:text-yellow-500 transition">Bảng giá</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold uppercase mb-3 text-xs tracking-widest">Hỗ trợ</h4>
                        <ul class="space-y-2 text-xs">
                            <li><a href="#" class="hover:text-yellow-500 transition">Điều khoản</a></li>
                            <li><a href="#" class="hover:text-yellow-500 transition">Chính sách</a></li>
                            <li><a href="#" class="hover:text-yellow-500 transition">Câu hỏi thường gặp</a></li>
                            <li><a href="#" class="hover:text-yellow-500 transition">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>

                {{-- Cột 3: Đăng ký & Social --}}
                <div class="space-y-4">
                    <h4 class="text-white font-bold uppercase text-xs tracking-widest">Kết nối với chúng tôi</h4>
                    
                    {{-- Form nhỏ gọn 1 dòng --}}
                    <form class="flex gap-2">
                        <input type="email" placeholder="Nhập email..." class="w-full bg-gray-800 border-none text-white text-xs px-3 py-2 rounded focus:ring-1 focus:ring-yellow-500 focus:bg-gray-700 transition">
                        <button class="bg-yellow-500 hover:bg-yellow-400 text-black font-bold uppercase text-xs px-4 py-2 rounded transition whitespace-nowrap">
                            Gửi
                        </button>
                    </form>

                    <div class="flex gap-3 pt-1">
                        <a href="https://www.facebook.com/luong.thieu.161004" class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center hover:bg-blue-600 hover:text-white transition text-xs"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/luong.thieu.161004/" class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center hover:bg-pink-600 hover:text-white transition text-xs"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center hover:bg-black hover:text-white border border-gray-700 hover:border-white transition text-xs"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="https://www.youtube.com/@luongkhanhthieu793" class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center hover:bg-red-600 hover:text-white transition text-xs"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
            </div>

            {{-- Copyright Bar --}}
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-xs text-gray-600">
                &copy; {{ date('Y') }} Thiuu Car Rental. All rights reserved.
            </div>
        </div>
    </footer>