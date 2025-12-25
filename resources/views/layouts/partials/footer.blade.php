<footer class="bg-dark-950 border-t border-gray-900 pt-12 pb-6 text-sm">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 mb-10">
            <div class="lg:col-span-1">
                <a href="#" class="flex items-center gap-2 mb-4">
                    <span class="text-gold-500 font-bold text-xl">T</span>
                    <span class="text-white font-bold text-base uppercase tracking-widest">Thiuu Car</span>
                </a>
                <p class="text-gray-500 text-xs leading-6 mb-4">
                    Kết nối khách hàng với những chuyến đi an toàn và đẳng cấp.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="text-gray-500 hover:text-white transition text-xs"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-500 hover:text-white transition text-xs"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="text-gray-500 hover:text-white transition text-xs"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>

            <div>
                <h5 class="text-white font-bold text-xs uppercase tracking-widest mb-4">Khám Phá</h5>
                <ul class="space-y-2 text-gray-500 text-xs">
                    <li><a href="#" class="hover:text-gold-500 transition">Về chúng tôi</a></li>
                    <li><a href="{{ route('vehicles.index') }}" class="hover:text-gold-500 transition">Dòng xe</a></li>
                    <li><a href="#" class="hover:text-gold-500 transition">Bảng giá</a></li>
                </ul>
            </div>

            <div>
                <h5 class="text-white font-bold text-xs uppercase tracking-widest mb-4">Liên Hệ</h5>
                <ul class="space-y-3 text-gray-500 text-xs">
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-location-dot mt-0.5 text-gold-500"></i>
                        <span>TP. Hồ Chí Minh</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-phone text-gold-500"></i>
                        <span class="text-white font-bold">0909 123 456</span>
                    </li>
                </ul>
            </div>

            <div>
                <h5 class="text-white font-bold text-xs uppercase tracking-widest mb-4">Đăng Ký</h5>
                <div class="flex flex-col gap-2">
                    <input type="email" placeholder="Email..." class="bg-dark-900 border border-gray-800 text-white px-3 py-2 rounded text-xs focus:border-gold-500 focus:outline-none transition">
                    <button class="bg-white hover:bg-gold-500 hover:text-white text-dark-950 font-bold uppercase text-[10px] py-2 rounded transition tracking-widest">
                        Gửi
                    </button>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-900 pt-6 flex flex-col md:flex-row justify-between items-center text-gray-600 text-[10px]">
            <p>&copy; 2025 Thiuu Car Rental.</p>
            <div class="flex gap-4 mt-2 md:mt-0">
                <a href="#" class="hover:text-white transition">Privacy</a>
                <a href="#" class="hover:text-white transition">Terms</a>
            </div>
        </div>
    </div>
</footer>