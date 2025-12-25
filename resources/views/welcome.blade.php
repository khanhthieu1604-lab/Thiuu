@extends('layouts.client')

@section('content')

    <div class="relative min-h-[600px] flex items-center justify-center overflow-hidden pt-16">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1503376763036-066120622c74?q=80&w=2070&auto=format&fit=crop" 
                 class="w-full h-full object-cover opacity-50">
            <div class="absolute inset-0 bg-gradient-to-t from-dark-950 via-dark-950/80 to-transparent"></div>
        </div>
        
        <div class="relative z-10 container mx-auto px-4 text-center mt-8">
            <h1 class="text-4xl md:text-6xl font-serif font-bold text-white mb-4 leading-tight">
                Nâng Tầm <span class="text-gradient">Mọi Chuyến Đi</span>
            </h1>
            <p class="text-gray-400 text-base mb-10 max-w-xl mx-auto font-light">
                Dịch vụ thuê xe đẳng cấp. Giao xe tận nơi, hỗ trợ 24/7.
            </p>

            <div class="bg-dark-900/80 backdrop-blur border border-white/10 rounded-lg p-4 max-w-4xl mx-auto shadow-2xl">
                <form action="{{ route('vehicles.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">
                    <div class="relative group">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-500 text-xs"></i>
                        <input type="text" name="search" placeholder="Tìm tên xe..." 
                            class="w-full bg-dark-950 border border-gray-800 text-white text-xs rounded px-3 py-2.5 pl-8 focus:outline-none focus:border-gold-500 transition">
                    </div>
                    <div class="relative group">
                        <select name="category" class="w-full bg-dark-950 border border-gray-800 text-gray-300 text-xs rounded px-3 py-2.5 focus:outline-none focus:border-gold-500 transition appearance-none">
                            <option value="">Loại xe</option>
                            <option value="Sedan">Sedan</option>
                            <option value="SUV">SUV</option>
                            <option value="Luxury">Luxury</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-3 top-3 text-[10px] text-gray-600 pointer-events-none"></i>
                    </div>
                    <div class="relative group">
                        <select name="price" class="w-full bg-dark-950 border border-gray-800 text-gray-300 text-xs rounded px-3 py-2.5 focus:outline-none focus:border-gold-500 transition appearance-none">
                            <option value="">Mức giá</option>
                            <option value="low">&lt; 1 Triệu</option>
                            <option value="medium">1 - 2 Triệu</option>
                            <option value="high">&gt; 2 Triệu</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-3 top-3 text-[10px] text-gray-600 pointer-events-none"></i>
                    </div>
                    <button type="submit" class="bg-gold-500 hover:bg-gold-600 text-dark-950 font-bold uppercase text-[10px] tracking-widest rounded py-2.5 transition">
                        Tìm Xe
                    </button>
                </form>
            </div>
        </div>
    </div>

    <section class="container mx-auto px-4 py-16">
        <div class="flex flex-col md:flex-row justify-between items-end mb-8 border-b border-gray-800 pb-4">
            <div>
                <span class="text-gold-500 text-[10px] font-bold uppercase tracking-[0.2em] mb-1 block">Our Fleet</span>
                <h2 class="text-2xl font-serif font-bold text-white">Xe Mới Nhất</h2>
            </div>
            <a href="{{ route('vehicles.index') }}" class="text-xs text-gray-400 hover:text-white transition flex items-center gap-2">
                Xem tất cả <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        @if(isset($recentVehicles) && $recentVehicles->count() > 0)
            {{-- GRID CHỈNH SỬA: Hiển thị 5 cột trên màn hình lớn để card nhỏ lại --}}
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($recentVehicles as $vehicle)
                    <div class="group relative bg-dark-900 border border-gray-800 rounded hover:border-gold-500/50 transition-all duration-300 flex flex-col">
                        <div class="relative h-32 overflow-hidden rounded-t bg-dark-800">
                            <a href="{{ route('vehicles.show', $vehicle->id) }}">
                                @if($vehicle->image)
                                    <img src="{{ asset($vehicle->image) }}" alt="{{ $vehicle->name }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-700">
                                        <i class="fa-solid fa-car text-3xl"></i>
                                    </div>
                                @endif
                            </a>
                            <div class="absolute top-2 left-2 bg-dark-950/90 text-white text-[8px] font-bold px-1.5 py-0.5 uppercase tracking-wider rounded border border-gray-700">
                                {{ $vehicle->brand }}
                            </div>
                        </div>

                        <div class="p-3 flex-grow flex flex-col">
                            <h3 class="text-sm font-bold text-white mb-2 truncate group-hover:text-gold-500 transition">
                                <a href="{{ route('vehicles.show', $vehicle->id) }}">{{ $vehicle->name }}</a>
                            </h3>
                            
                            <div class="flex items-center justify-between text-[9px] text-gray-500 border-t border-gray-800 pt-2 mb-3">
                                <span class="flex items-center gap-1"><i class="fa-solid fa-user-group"></i> 5</span>
                                <span class="flex items-center gap-1"><i class="fa-solid fa-gas-pump"></i> Xăng</span>
                                <span class="flex items-center gap-1"><i class="fa-solid fa-gear"></i> Auto</span>
                            </div>

                            <div class="mt-auto flex items-center justify-between">
                                <div>
                                    <p class="text-gold-500 font-bold text-sm leading-none">
                                        {{ number_format($vehicle->rent_price_per_day) }}
                                    </p>
                                </div>
                                <a href="{{ route('vehicles.show', $vehicle->id) }}" class="w-6 h-6 flex items-center justify-center border border-gray-700 rounded-full text-gray-400 hover:bg-gold-500 hover:border-gold-500 hover:text-dark-950 transition text-[10px]">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-16 text-center border border-dashed border-gray-800 rounded-lg">
                <p class="text-gray-600 text-xs">Chưa có dữ liệu xe.</p>
            </div>
        @endif
    </section>

    <section class="bg-dark-900 py-12 border-t border-gray-800">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-dark-950 p-5 border border-gray-800 rounded hover:border-gold-500/30 transition text-center">
                    <i class="fa-solid fa-medal text-2xl text-gold-600 mb-3"></i>
                    <h4 class="text-white font-bold text-sm uppercase mb-2">Chất Lượng Vàng</h4>
                    <p class="text-gray-500 text-xs">100% xe đời mới, sạch sẽ, không mùi.</p>
                </div>
                <div class="bg-dark-950 p-5 border border-gray-800 rounded hover:border-gold-500/30 transition text-center">
                    <i class="fa-solid fa-hand-holding-dollar text-2xl text-gold-600 mb-3"></i>
                    <h4 class="text-white font-bold text-sm uppercase mb-2">Giá Minh Bạch</h4>
                    <p class="text-gray-500 text-xs">Niêm yết rõ ràng, không phí ẩn.</p>
                </div>
                <div class="bg-dark-950 p-5 border border-gray-800 rounded hover:border-gold-500/30 transition text-center">
                    <i class="fa-solid fa-headset text-2xl text-gold-600 mb-3"></i>
                    <h4 class="text-white font-bold text-sm uppercase mb-2">Hỗ Trợ 24/7</h4>
                    <p class="text-gray-500 text-xs">Luôn sẵn sàng hỗ trợ mọi lúc mọi nơi.</p>
                </div>
            </div>
        </div>
    </section>

@endsection