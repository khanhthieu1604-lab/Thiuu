<header class="fixed w-full top-0 z-50 transition-all duration-300 bg-dark-950/90 backdrop-blur-md border-b border-white/5">
    <div class="container mx-auto px-4 h-16 flex items-center justify-between"> <a href="{{ url('/') }}" class="flex items-center gap-2 group">
            <div class="w-8 h-8 border border-gold-500 rounded-sm flex items-center justify-center text-gold-500 font-bold text-lg group-hover:bg-gold-500 group-hover:text-dark-950 transition duration-300">
                T
            </div>
            <div class="flex flex-col">
                <h1 class="font-bold text-base text-white uppercase tracking-widest leading-none group-hover:text-gold-500 transition">Thiuu</h1>
                <span class="text-[8px] text-gray-500 uppercase tracking-[0.3em]">Car Rental</span>
            </div>
        </a>

        <nav class="hidden md:flex items-center gap-8 text-xs font-bold uppercase tracking-widest">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-gold-500' : 'text-gray-400 hover:text-white' }} transition py-2">Trang chủ</a>
            <a href="{{ route('vehicles.index') }}" class="{{ request()->routeIs('vehicles.*') ? 'text-gold-500' : 'text-gray-400 hover:text-white' }} transition py-2">Danh sách xe</a>
            <a href="{{ url('/pricing') }}" class="text-gray-400 hover:text-white transition py-2">Dịch vụ</a>
            <a href="{{ url('/contact') }}" class="text-gray-400 hover:text-white transition py-2">Liên hệ</a>
        </nav>

        <div class="flex items-center gap-3">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-xs font-bold text-white border border-gray-700 px-4 py-2 rounded hover:border-gold-500 hover:text-gold-500 transition uppercase tracking-wider">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="text-xs font-bold text-gray-400 hover:text-white uppercase transition tracking-wider">Login</a>
                <span class="w-[1px] h-3 bg-gray-700"></span>
                <a href="{{ route('register') }}" class="text-xs font-bold text-gold-500 hover:text-gold-400 uppercase transition tracking-wider">Register</a>
            @endauth
        </div>
    </div>
</header>