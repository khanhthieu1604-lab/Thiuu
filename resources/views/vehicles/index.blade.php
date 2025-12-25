@extends('layouts.app')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-10 transition-colors duration-300">
    <div class="container mx-auto px-4">
        
        <div class="mb-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-6 gap-4">
                <div>
                    <span class="text-yellow-500 text-xs font-bold uppercase tracking-[0.2em] mb-2 block">Thiuu Rental Fleet</span>
                    <h1 class="text-3xl font-heading font-bold text-gray-900 dark:text-white uppercase tracking-wide transition-colors">
                        Danh Sách <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">Xe Cho Thuê</span>
                    </h1>
                </div>

                <div class="relative">
                    <select onchange="window.location.href=this.value" class="appearance-none bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-white text-xs rounded px-4 py-2 pr-8 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 cursor-pointer shadow-sm transition-colors font-bold">
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}">Mới nhất</option>
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá thấp đến cao</option>
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá cao đến thấp</option>
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-3 top-2.5 text-gray-500 text-[10px] pointer-events-none"></i>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg p-1.5 border border-gray-200 dark:border-gray-700 shadow-lg transition-colors">
                <form action="{{ route('vehicles.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-2">
                    <div class="relative group">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-3.5 text-gray-400 text-xs group-focus-within:text-yellow-500 transition"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm tên xe..." 
                            class="w-full bg-gray-50 dark:bg-gray-900 border-0 rounded text-gray-900 dark:text-white text-xs pl-9 pr-3 py-3 focus:ring-2 focus:ring-yellow-500 transition placeholder-gray-400">
                    </div>
                    <div class="relative group">
                        <select name="category" class="w-full bg-gray-50 dark:bg-gray-900 border-0 text-gray-900 dark:text-white text-xs rounded px-3 py-3 focus:ring-2 focus:ring-yellow-500 transition appearance-none cursor-pointer">
                            <option value="">Loại xe</option>
                            <option value="Sedan" {{ request('category') == 'Sedan' ? 'selected' : '' }}>Sedan (4 chỗ)</option>
                            <option value="SUV" {{ request('category') == 'SUV' ? 'selected' : '' }}>SUV (7 chỗ)</option>
                            <option value="Limousine" {{ request('category') == 'Limousine' ? 'selected' : '' }}>Limousine</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-3 top-3.5 text-gray-500 text-xs pointer-events-none"></i>
                    </div>
                    <div class="relative group">
                        <select name="price" class="w-full bg-gray-50 dark:bg-gray-900 border-0 text-gray-900 dark:text-white text-xs rounded px-3 py-3 focus:ring-2 focus:ring-yellow-500 transition appearance-none cursor-pointer">
                            <option value="">Mức giá</option>
                            <option value="under_1m" {{ request('price') == 'under_1m' ? 'selected' : '' }}>&lt; 1 Triệu</option>
                            <option value="1m_2m" {{ request('price') == '1m_2m' ? 'selected' : '' }}>1 - 2 Triệu</option>
                            <option value="above_2m" {{ request('price') == 'above_2m' ? 'selected' : '' }}>&gt; 2 Triệu</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-3 top-3.5 text-gray-500 text-xs pointer-events-none"></i>
                    </div>
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-400 text-blue-900 font-bold uppercase text-xs rounded py-3 transition shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                        <i class="fa-solid fa-filter"></i> Lọc Xe
                    </button>
                </form>
            </div>
        </div>

        @if($vehicles->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($vehicles as $vehicle)
                    <div class="group bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:border-yellow-500/50 hover:shadow-xl transition-all duration-300 flex flex-col">
                        
                        <div class="relative h-48 overflow-hidden bg-gray-100 dark:bg-gray-900">
                            <a href="{{ route('vehicles.show', $vehicle->id) }}" class="block w-full h-full">
                                @if($vehicle->image)
                                    <img src="{{ asset($vehicle->image) }}" alt="{{ $vehicle->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-out">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-gray-600"><i class="fa-solid fa-car text-4xl"></i></div>
                                @endif
                            </a>
                            
                            <div class="absolute top-3 left-3">
                                <span class="bg-black/60 backdrop-blur text-white text-[10px] font-bold px-2 py-1 rounded border border-white/20 uppercase tracking-wide">
                                    {{ $vehicle->brand }}
                                </span>
                            </div>

                            <div class="absolute top-3 right-3 z-10">
                                @if($vehicle->status == 'available')
                                    <div class="relative group/tooltip">
                                        <div class="w-3 h-3 bg-green-500 rounded-full shadow-[0_0_10px_rgba(34,197,94,0.8)] border border-white/50 animate-pulse cursor-pointer"></div>
                                        <div class="absolute right-0 top-5 w-max px-2 py-1 bg-black text-white text-[9px] rounded opacity-0 group-hover/tooltip:opacity-100 transition duration-200 pointer-events-none">
                                            Sẵn sàng
                                        </div>
                                    </div>
                                @else
                                    <div class="relative group/tooltip">
                                        <div class="w-3 h-3 bg-red-500 rounded-full shadow-[0_0_10px_rgba(239,68,68,0.8)] border border-white/50 cursor-pointer"></div>
                                        <div class="absolute right-0 top-5 w-max px-2 py-1 bg-black text-white text-[9px] rounded opacity-0 group-hover/tooltip:opacity-100 transition duration-200 pointer-events-none">
                                            Đã được thuê
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="p-4 flex-grow flex flex-col">
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-1 truncate group-hover:text-yellow-500 transition">
                                <a href="{{ route('vehicles.show', $vehicle->id) }}">{{ $vehicle->name }}</a>
                            </h3>
                            
                            <p class="text-[10px] text-gray-500 dark:text-gray-400 mb-4 uppercase tracking-wide font-medium">
                                {{ $vehicle->type ?? 'Luxury' }} • Đời 2023
                            </p>
                            
                            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 border-t border-gray-100 dark:border-gray-700/50 pt-3 mb-4">
                                <div class="flex items-center gap-1.5" title="Số chỗ">
                                    <i class="fa-solid fa-user-group text-yellow-500"></i> <span class="font-medium">5</span>
                                </div>
                                <div class="flex items-center gap-1.5" title="Nhiên liệu">
                                    <i class="fa-solid fa-gas-pump text-yellow-500"></i> <span class="font-medium">Xăng</span>
                                </div>
                                <div class="flex items-center gap-1.5" title="Hộp số">
                                    <i class="fa-solid fa-gear text-yellow-500"></i> <span class="font-medium">Auto</span>
                                </div>
                            </div>

                            <div class="mt-auto flex items-end justify-between">
                                <div>
                                    <p class="text-[9px] text-gray-400 uppercase tracking-wider mb-0.5">Giá thuê</p>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-lg font-bold text-blue-700 dark:text-yellow-500">
                                            {{ number_format($vehicle->rent_price_per_day / 1000) }}k
                                        </span>
                                        <span class="text-[10px] text-gray-500">/ngày</span>
                                    </div>
                                </div>
                                <a href="{{ route('vehicles.show', $vehicle->id) }}" class="bg-white dark:bg-gray-700 hover:bg-yellow-500 hover:text-white dark:hover:text-gray-900 text-gray-900 dark:text-white text-[10px] font-bold uppercase px-4 py-2 rounded border border-gray-200 dark:border-gray-600 transition shadow-sm hover:shadow-md transform active:scale-95 whitespace-nowrap">
                                    Đặt xe
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md px-4 py-2 border border-gray-200 dark:border-gray-700">
                    {{ $vehicles->withQueryString()->onEachSide(1)->links('pagination::tailwind') }}
                </div>
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-24 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-800/30">
                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-solid fa-car-tunnel text-3xl text-gray-400 dark:text-gray-500"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">Chưa tìm thấy xe</h3>
                <p class="text-gray-500 text-xs mt-1 mb-6">Thử điều chỉnh bộ lọc để tìm kết quả khác.</p>
                <a href="{{ route('vehicles.index') }}" class="text-yellow-600 dark:text-yellow-500 hover:underline text-xs font-bold uppercase tracking-widest">
                    Xóa bộ lọc
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    /* Pagination Styles */
    nav[role="navigation"] div.hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between > div:first-child { display: none; }
    nav[role="navigation"] div.hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between { justify-content: center; }
    
    .dark nav span[aria-current="page"] span { background-color: #eab308 !important; color: black !important; border-color: #eab308 !important; }
    .dark nav a { background-color: #1f2937 !important; border-color: #374151 !important; color: #9ca3af !important; }
    .dark nav a:hover { background-color: #374151 !important; color: white !important; }
    .dark nav span[aria-disabled="true"] span { background-color: #1f2937 !important; border-color: #374151 !important; color: #4b5563 !important; }
</style>
@endsection