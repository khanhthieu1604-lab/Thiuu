@extends('layouts.app')

@section('content')

    <div class="relative bg-gray-900 h-[500px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?q=80&w=2070&auto=format&fit=crop" 
                 class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-gray-900/50"></div>
        </div>
        
        <div class="relative z-10 container mx-auto px-4 text-center">
            <span class="bg-yellow-500 text-blue-900 font-bold px-3 py-1 text-[10px] uppercase tracking-widest mb-4 inline-block rounded shadow">
                Premium Car Rental
            </span>
            <h1 class="text-4xl md:text-6xl font-heading font-bold text-white mb-4 drop-shadow-xl">
                Hành Trình <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">Đẳng Cấp</span>
            </h1>
            <p class="text-gray-300 text-sm md:text-base mb-8 max-w-xl mx-auto font-light">
                Trải nghiệm dịch vụ thuê xe tự lái & có tài xế chuẩn 5 sao. Xe đời mới, thủ tục minh bạch, giao xe tận nơi.
            </p>

            <div class="bg-white/10 backdrop-blur-md border border-white/20 p-3 rounded-lg max-w-4xl mx-auto shadow-2xl">
                <form action="{{ route('vehicles.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-2">
                    <input type="text" name="search" placeholder="Tìm tên xe..." class="bg-white/90 border-0 rounded text-xs px-3 py-3 focus:ring-2 focus:ring-yellow-500 text-gray-900 placeholder-gray-500">
                    
                    <select name="category" class="bg-white/90 border-0 rounded text-xs px-3 py-3 focus:ring-2 focus:ring-yellow-500 text-gray-900 cursor-pointer">
                        <option value="">Loại xe</option>
                        <option value="Sedan">Sedan (4 chỗ)</option>
                        <option value="SUV">SUV (7 chỗ)</option>
                    </select>
                    
                    <select name="price" class="bg-white/90 border-0 rounded text-xs px-3 py-3 focus:ring-2 focus:ring-yellow-500 text-gray-900 cursor-pointer">
                        <option value="">Mức giá</option>
                        <option value="low">&lt; 1 Triệu</option>
                        <option value="medium">1 - 2 Triệu</option>
                        <option value="high">&gt; 2 Triệu</option>
                    </select>
                    
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-400 text-blue-900 font-bold uppercase text-xs rounded py-3 transition shadow-lg flex items-center justify-center gap-2">
                        <i class="fa-solid fa-magnifying-glass"></i> Tìm Xe
                    </button>
                </form>
            </div>
        </div>
    </div>

    <section class="container mx-auto px-4 py-16">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 border-b border-gray-800 pb-4">
            <div>
                <span class="text-yellow-500 text-xs font-bold uppercase tracking-[0.2em] mb-2 block">Bộ sưu tập</span>
                <h2 class="text-3xl font-heading font-bold text-black">Xe Mới Nhất</h2>
            </div>
            <a href="{{ route('vehicles.index') }}" class="group flex items-center gap-2 text-sm text-gray-400 hover:text-white transition mt-4 md:mt-0">
                <span class="uppercase tracking-wider text-xs font-bold">Xem tất cả</span>
                <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition text-yellow-500"></i>
            </a>
        </div>

        @if(isset($recentVehicles) && $recentVehicles->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($recentVehicles as $vehicle)
                    <div class="group bg-gray-900 border border-gray-800 rounded-lg overflow-hidden hover:border-yellow-500/50 hover:shadow-[0_0_15px_rgba(234,179,8,0.1)] transition-all duration-300 flex flex-col">
                        
                        <div class="relative h-48 bg-gray-800 overflow-hidden">
                            <a href="{{ route('vehicles.show', $vehicle->id) }}" class="block w-full h-full">
                                @if($vehicle->image)
                                    <img src="{{ asset($vehicle->image) }}" alt="{{ $vehicle->name }}" class="w-full h-full object-cover opacity-90 group-hover:opacity-100 group-hover:scale-105 transition duration-700 ease-out">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-700 bg-gray-800">
                                        <i class="fa-solid fa-car text-4xl"></i>
                                    </div>
                                @endif
                            </a>
                            
                            <div class="absolute top-3 left-3">
                                <span class="bg-black/60 backdrop-blur text-white text-[10px] font-bold px-2 py-1 rounded border border-gray-700 uppercase tracking-wide">
                                    {{ $vehicle->brand }}
                                </span>
                            </div>
                            
                            <button class="absolute top-3 right-3 w-7 h-7 bg-black/60 backdrop-blur rounded-full flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-white transition">
                                <i class="fa-regular fa-heart text-xs"></i>
                            </button>
                        </div>

                        <div class="p-4 flex-grow flex flex-col">
                            <h3 class="text-base font-bold text-white mb-1 truncate group-hover:text-yellow-500 transition">
                                <a href="{{ route('vehicles.show', $vehicle->id) }}">{{ $vehicle->name }}</a>
                            </h3>
                            
                            <p class="text-xs text-gray-500 mb-4">{{ $vehicle->type ?? 'Sedan' }} • Đời 2023</p>
                            
                            <div class="flex items-center gap-4 text-xs text-gray-400 border-t border-gray-800 pt-3 mb-4">
                                <div class="flex items-center gap-1.5" title="Số chỗ">
                                    <i class="fa-solid fa-user-group text-yellow-600"></i> <span>5</span>
                                </div>
                                <div class="flex items-center gap-1.5" title="Nhiên liệu">
                                    <i class="fa-solid fa-gas-pump text-yellow-600"></i> <span>Xăng</span>
                                </div>
                                <div class="flex items-center gap-1.5" title="Hộp số">
                                    <i class="fa-solid fa-gear text-yellow-600"></i> <span>Tự động</span>
                                </div>
                            </div>

                            <div class="mt-auto flex items-end justify-between">
                                <div>
                                    <p class="text-[10px] text-gray-500 uppercase tracking-wider mb-0.5">Giá thuê</p>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-lg font-bold text-yellow-500">{{ number_format($vehicle->rent_price_per_day / 1000) }}k</span>
                                        <span class="text-xs text-gray-500">/ngày</span>
                                    </div>
                                </div>
                                <a href="{{ route('vehicles.show', $vehicle->id) }}" class="bg-white text-black hover:bg-yellow-500 hover:text-black px-4 py-2 rounded text-xs font-bold uppercase transition tracking-wide transform active:scale-95">
                                    Đặt xe
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-20 text-center border border-dashed border-gray-800 rounded-lg bg-gray-900/50">
                <i class="fa-solid fa-car-tunnel text-4xl text-gray-700 mb-4"></i>
                <p class="text-gray-500 text-sm">Hiện chưa có xe nào được đăng tải.</p>
            </div>
        @endif
    </section>

    <section class="bg-gray-50 dark:bg-gray-800/50 py-12 border-t border-gray-200 dark:border-gray-800">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <div class="p-4 group">
                    <div class="w-12 h-12 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm group-hover:scale-110 transition">
                        <i class="fa-solid fa-medal text-2xl text-yellow-500"></i>
                    </div>
                    <h4 class="font-bold text-sm text-gray-900 dark:text-white uppercase mb-1">Chất Lượng Vàng</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400 px-4">100% xe đời mới, sạch sẽ, không mùi hôi.</p>
                </div>
                <div class="p-4 group">
                    <div class="w-12 h-12 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm group-hover:scale-110 transition">
                        <i class="fa-solid fa-bolt text-2xl text-yellow-500"></i>
                    </div>
                    <h4 class="font-bold text-sm text-gray-900 dark:text-white uppercase mb-1">Thủ Tục Nhanh</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400 px-4">Nhận xe chỉ sau 5 phút làm việc.</p>
                </div>
                <div class="p-4 group">
                    <div class="w-12 h-12 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm group-hover:scale-110 transition">
                        <i class="fa-solid fa-headset text-2xl text-yellow-500"></i>
                    </div>
                    <h4 class="font-bold text-sm text-gray-900 dark:text-white uppercase mb-1">Hỗ Trợ 24/7</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400 px-4">Luôn bên bạn mọi lúc mọi nơi.</p>
                </div>
            </div>
        </div>
    </section>

@endsection