@extends('layouts.app')

@section('content')

    <div class="relative bg-gray-900 h-[600px] flex items-center transition-colors duration-300">
        <img src="https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?q=80&w=2070&auto=format&fit=crop"
             class="absolute inset-0 w-full h-full object-cover opacity-50 dark:opacity-30 transition-opacity duration-300">

        <div class="relative container mx-auto px-4 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="text-white">
                <span class="bg-yellow-500 text-blue-900 font-bold px-3 py-1 text-xs uppercase tracking-widest mb-4 inline-block rounded-sm shadow">Uy tín - Chất lượng</span>
                <h1 class="text-4xl md:text-6xl font-bold font-heading leading-tight mb-6 drop-shadow-lg">
                    Thuê Xe Tự Lái & <br> Du Lịch Trọn Gói
                </h1>
                <p class="text-gray-200 text-lg mb-8 max-w-md drop-shadow-md">
                    Hơn 100+ dòng xe đời mới sẵn sàng phục vụ. Thủ tục đơn giản, giao xe tận nơi 24/7.
                </p>
                <a href="{{ route('vehicles.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded font-bold uppercase text-sm tracking-wider inline-flex items-center shadow-lg transition transform hover:-translate-y-1">
                    Xem tất cả xe <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-2xl border-t-4 border-yellow-500 transform translate-y-8 lg:translate-y-0 transition-colors duration-300">
                <h3 class="text-blue-900 dark:text-white font-bold text-xl mb-4 border-b border-gray-100 dark:border-gray-700 pb-2 transition-colors duration-300">Tìm xe nhanh</h3>
                <form action="{{ route('vehicles.index') }}" method="GET" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-1 transition-colors duration-300">Loại xe</label>
                        <div class="relative">
                            <i class="fa-solid fa-car absolute left-3 top-3.5 text-gray-400 dark:text-gray-500 z-10 transition-colors duration-300"></i>
                            <select name="category" class="w-full border border-gray-300 dark:border-gray-600 rounded pl-10 pr-3 py-3 text-gray-700 dark:text-gray-200 focus:outline-none focus:border-blue-500 font-medium bg-white dark:bg-gray-700 transition-colors duration-300 appearance-none">
                                <option value="">Tất cả dòng xe</option>
                                <option value="Sedan">Sedan (4 chỗ)</option>
                                <option value="SUV">SUV (7 chỗ)</option>
                                <option value="Limousine">Limousine VIP</option>
                                <option value="Mazda">Mazda</option>
                                <option value="Toyota">Toyota</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-1 transition-colors duration-300">Điểm nhận xe</label>
                        <div class="relative">
                            <i class="fa-solid fa-location-dot absolute left-3 top-3.5 text-gray-400 dark:text-gray-500 transition-colors duration-300"></i>
                            <input type="text" name="location" placeholder="Nhập quận/huyện..." class="w-full border border-gray-300 dark:border-gray-600 rounded pl-10 pr-3 py-3 text-gray-700 dark:text-white focus:outline-none focus:border-blue-500 font-medium bg-white dark:bg-gray-700 transition-colors duration-300 placeholder-gray-400 dark:placeholder-gray-500">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-800 hover:bg-blue-900 dark:bg-blue-700 dark:hover:bg-blue-600 text-white font-bold py-3.5 rounded shadow-md transition uppercase text-sm tracking-wide mt-2">
                        Tìm kiếm ngay
                    </button>
                </form>
            </div>
        </div>
    </div>

    <section id="services" class="py-20 bg-gray-50 dark:bg-gray-900 mt-10 md:mt-0 transition-colors duration-300">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-blue-600 dark:text-blue-400 font-bold uppercase text-xs tracking-widest transition-colors duration-300">Dịch vụ của chúng tôi</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mt-2 font-heading transition-colors duration-300">Giải pháp di chuyển hoàn hảo</h2>
                <div class="w-16 h-1 bg-yellow-500 mx-auto mt-4 rounded"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white dark:bg-gray-800 p-8 rounded shadow-sm hover:shadow-xl transition border-b-4 border-transparent hover:border-blue-800 group text-center transform hover:-translate-y-1 duration-300">
                    <div class="w-20 h-20 bg-blue-50 dark:bg-gray-700 rounded-full flex items-center justify-center text-blue-800 dark:text-blue-400 text-3xl mb-6 mx-auto group-hover:bg-blue-800 group-hover:text-white transition-colors duration-300">
                        <i class="fa-solid fa-car-side"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800 dark:text-white">Thuê xe tự lái</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">Thủ tục đơn giản (CCCD + Xe máy), giao xe tận nhà. Đa dạng dòng xe từ phổ thông đến cao cấp.</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-8 rounded shadow-sm hover:shadow-xl transition border-b-4 border-transparent hover:border-blue-800 group text-center transform hover:-translate-y-1 duration-300">
                    <div class="w-20 h-20 bg-blue-50 dark:bg-gray-700 rounded-full flex items-center justify-center text-blue-800 dark:text-blue-400 text-3xl mb-6 mx-auto group-hover:bg-blue-800 group-hover:text-white transition-colors duration-300">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800 dark:text-white">Có tài xế riêng</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">Tài xế chuyên nghiệp, lịch sự, rành đường. Phục vụ công tác, đưa đón sân bay, đi tỉnh.</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-8 rounded shadow-sm hover:shadow-xl transition border-b-4 border-transparent hover:border-blue-800 group text-center transform hover:-translate-y-1 duration-300">
                    <div class="w-20 h-20 bg-blue-50 dark:bg-gray-700 rounded-full flex items-center justify-center text-blue-800 dark:text-blue-400 text-3xl mb-6 mx-auto group-hover:bg-blue-800 group-hover:text-white transition-colors duration-300">
                        <i class="fa-solid fa-bus"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800 dark:text-white">Thuê xe du lịch</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">Xe 16 - 29 - 45 chỗ đời mới cho gia đình, công ty đi du lịch. Giá trọn gói ưu đãi.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="fleet" class="py-20 bg-white dark:bg-black transition-colors duration-300">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 border-b border-gray-100 dark:border-gray-800 pb-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white font-heading">Đội xe mới nhất</h2>
                    <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm">Cập nhật liên tục các mẫu xe 2023 - 2024</p>
                </div>
                <a href="{{ route('vehicles.index') }}" class="text-blue-700 dark:text-blue-400 font-bold hover:text-blue-900 text-sm uppercase mt-4 md:mt-0 flex items-center">
                    Xem tất cả <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($recentVehicles as $vehicle)
                <div class="border border-gray-200 dark:border-gray-800 rounded-lg overflow-hidden hover:shadow-xl transition group bg-white dark:bg-gray-900 flex flex-col">
                    
                    <div class="relative h-48 bg-gray-100 dark:bg-gray-800 overflow-hidden">
                        @if($vehicle->image)
                            <img src="{{ asset($vehicle->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400"><i class="fa-solid fa-image text-4xl"></i></div>
                        @endif
                        
                        <div class="absolute top-2 left-2 bg-blue-900 text-white text-[10px] font-bold px-2 py-1 rounded uppercase shadow">
                            {{ $vehicle->brand }}
                        </div>

                        <div class="absolute bottom-2 right-2 bg-black/60 text-white text-[10px] font-bold px-2 py-1 rounded backdrop-blur-sm">
                            {{ $vehicle->type }}
                        </div>
                    </div>

                    <div class="p-4 flex-grow flex flex-col">
                        <h4 class="font-bold text-gray-900 dark:text-white truncate mb-2 text-lg hover:text-blue-700 dark:hover:text-blue-400 transition">
                            <a href="{{ route('vehicles.show', $vehicle->id) }}">{{ $vehicle->name }}</a>
                        </h4>
                        
                        <div class="flex items-center gap-3 text-[11px] text-gray-500 dark:text-gray-400 uppercase font-bold mb-4 border-b border-gray-100 dark:border-gray-800 pb-3">
                            <span class="flex items-center"><i class="fa-solid fa-gas-pump mr-1.5 text-yellow-500"></i> Xăng</span>
                            <span class="flex items-center"><i class="fa-solid fa-gear mr-1.5 text-yellow-500"></i> Auto</span>
                            <span class="flex items-center"><i class="fa-solid fa-chair mr-1.5 text-yellow-500"></i> {{ $vehicle->type == 'SUV' ? '7' : '4' }}</span>
                        </div>
                        
                        <div class="mt-auto flex justify-between items-center">
                            <div>
                                <span class="block text-blue-800 dark:text-blue-400 font-bold text-lg leading-none">{{ number_format($vehicle->rent_price_per_day) }}đ</span>
                                <span class="text-gray-400 dark:text-gray-500 text-[10px] uppercase font-bold">/ngày</span>
                            </div>
                            <a href="{{ route('vehicles.show', $vehicle->id) }}" class="bg-yellow-500 hover:bg-yellow-400 text-blue-900 px-4 py-2 rounded text-xs font-bold uppercase transition shadow hover:shadow-md">
                                Đặt xe
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-8 text-center md:hidden">
                 <a href="{{ route('vehicles.index') }}" class="inline-block border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 px-6 py-2 rounded-full font-bold text-sm hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                    Xem tất cả xe
                </a>
            </div>
        </div>
    </section>
@endsection