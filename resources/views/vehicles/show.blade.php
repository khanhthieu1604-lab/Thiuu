<div class="lg:w-1/3">
            <div class="sticky top-24 space-y-6">
                
                <div class="bg-white rounded-lg shadow-lg border-t-4 border-yellow-500 p-6">
                    <h1 class="text-2xl font-bold text-gray-900 font-heading mb-2 hidden lg:block">{{ $vehicle->name }}</h1>
                    
                    <div class="flex items-end gap-2 mb-6 border-b border-gray-100 pb-4">
                        <span class="text-3xl font-bold text-blue-800">{{ number_format($vehicle->rent_price_per_day) }}đ</span>
                        <span class="text-gray-500 mb-1 font-medium">/ngày</span>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-4 text-sm flex items-start">
                            <i class="fa-solid fa-check-circle mt-0.5 mr-2"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($vehicle->status == 'available')
                        {{-- LOGIC: Nếu đã đăng nhập thì hiện Form, chưa thì chỉ hiện chữ --}}
                        @auth
                            <form action="{{ route('rentals.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                                
                                <div class="space-y-4 mb-6">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Ngày nhận xe <span class="text-red-500">*</span></label>
                                        <input type="date" name="start_date" required min="{{ date('Y-m-d') }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-800 text-sm font-medium">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Ngày trả xe <span class="text-red-500">*</span></label>
                                        <input type="date" name="end_date" required min="{{ date('Y-m-d') }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-800 text-sm font-medium">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Ghi chú (Tùy chọn)</label>
                                        <textarea name="note" rows="2" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-800 text-sm" placeholder="VD: Đón tại sân bay Tân Sơn Nhất..."></textarea>
                                    </div>
                                </div>

                                <button type="submit" class="w-full bg-blue-800 hover:bg-blue-900 text-white font-bold py-3.5 rounded uppercase tracking-wide transition shadow-lg flex justify-center items-center group">
                                    <i class="fa-regular fa-calendar-check mr-2 group-hover:scale-110 transition"></i> Xác nhận đặt xe
                                </button>
                                <p class="text-xs text-gray-500 mt-2 text-center">Chưa cần thanh toán ngay.</p>
                            </form>
                        @else
                            {{-- KHÁCH VÃNG LAI: Chỉ hiện thông báo text đơn giản --}}
                            <div class="text-center py-6 bg-gray-50 rounded border border-gray-100 px-4">
                                <p class="text-gray-500 italic text-sm">
                                    <i class="fa-solid fa-lock mr-1"></i> Vui lòng đăng nhập để đặt xe này.
                                </p>
                            </div>
                        @endauth
                    @else
                        {{-- XE KHÔNG SẴN SÀNG --}}
                        <div class="bg-gray-100 p-6 text-center rounded border border-gray-200">
                            <i class="fa-solid fa-ban text-4xl text-gray-400 mb-3"></i>
                            <h3 class="font-bold text-gray-600">Tạm thời hết xe</h3>
                            <p class="text-sm text-gray-500 mt-1">Xe này đang được thuê. Vui lòng chọn xe khác.</p>
                            <a href="{{ route('vehicles.index') }}" class="inline-block mt-4 text-blue-700 font-bold hover:underline">Xem xe khác &rarr;</a>
                        </div>
                    @endif

                    <div class="border-t border-gray-100 mt-6 pt-4 text-center">
                        <a href="tel:0909123456" class="text-yellow-600 font-bold hover:text-yellow-500 transition flex justify-center items-center">
                            <i class="fa-solid fa-phone-volume mr-2 animate-pulse"></i> Hotline: 0909.123.456
                        </a>
                    </div>
                </div>

                {{-- Phần cam kết dịch vụ (giữ nguyên) --}}
                <div class="bg-blue-50 rounded-lg border border-blue-100 p-5">
                    <h4 class="font-bold text-blue-900 mb-3 flex items-center text-sm uppercase tracking-wide">
                        <i class="fa-solid fa-shield-halved mr-2"></i> Cam kết dịch vụ
                    </h4>
                    <ul class="text-sm space-y-3 text-blue-800">
                        <li class="flex items-start">
                            <i class="fa-solid fa-check text-green-500 mr-2 mt-0.5"></i>
                            <span><strong>Xe đời mới:</strong> 100% xe đời 2022-2024, sạch sẽ, không mùi.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fa-solid fa-check text-green-500 mr-2 mt-0.5"></i>
                            <span><strong>Giao xe tận nơi:</strong> Miễn phí giao xe nội thành bán kính 5km.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fa-solid fa-check text-green-500 mr-2 mt-0.5"></i>
                            <span><strong>Hỗ trợ 24/7:</strong> Xử lý sự cố kỹ thuật trên mọi cung đường.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>