@extends('layouts.app')

@section('title', 'Phòng nghỉ')
@section('description', 'Khám phá các loại phòng sang trọng tại KThiuu Hotel - từ Standard đến Luxury Suite với đầy đủ tiện nghi.')

@section('content')
<!-- Page Header -->
<section class="bg-green-900 py-20">
    <div class="container-custom text-center text-white">
        <h1 class="text-4xl font-bold mb-4" style="font-family: 'Playfair Display', serif;">Phòng nghỉ</h1>
        <p class="text-gray-300 max-w-xl mx-auto">Khám phá các loại phòng sang trọng được thiết kế tinh tế, mang đến trải nghiệm nghỉ dưỡng hoàn hảo.</p>
    </div>
</section>

<section class="section">
    <div class="container-custom">
        <div class="grid lg:grid-cols-4 gap-8">
            <!-- Sidebar Filters -->
            <div class="lg:col-span-1">
                <div class="bg-white p-6 border border-gray-100 sticky top-28">
                    <h3 class="text-lg font-semibold mb-6" style="font-family: 'Playfair Display', serif;">Bộ lọc</h3>

                    <form action="{{ route('rooms.index') }}" method="GET">
                        <!-- Check-in/out -->
                        <div class="mb-6">
                            <label class="booking-label">Ngày nhận phòng</label>
                            <input type="date" name="check_in" class="booking-input" value="{{ request('check_in') }}" min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="mb-6">
                            <label class="booking-label">Ngày trả phòng</label>
                            <input type="date" name="check_out" class="booking-input" value="{{ request('check_out') }}">
                        </div>

                        <!-- Room Type -->
                        <div class="mb-6">
                            <label class="booking-label">Loại phòng</label>
                            <select name="type" class="booking-input">
                                <option value="">Tất cả</option>
                                @foreach($roomTypes as $type)
                                <option value="{{ $type->slug }}" {{ request('type') == $type->slug ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Guests -->
                        <div class="mb-6">
                            <label class="booking-label">Số khách</label>
                            <select name="guests" class="booking-input">
                                <option value="">Tất cả</option>
                                @for($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" {{ request('guests') == $i ? 'selected' : '' }}>{{ $i }} Khách</option>
                                    @endfor
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-6">
                            <label class="booking-label">Giá tối thiểu</label>
                            <input type="number" name="min_price" class="booking-input" placeholder="VNĐ" value="{{ request('min_price') }}">
                        </div>
                        <div class="mb-6">
                            <label class="booking-label">Giá tối đa</label>
                            <input type="number" name="max_price" class="booking-input" placeholder="VNĐ" value="{{ request('max_price') }}">
                        </div>

                        <button type="submit" class="btn-primary w-full">Tìm kiếm</button>
                        <a href="{{ route('rooms.index') }}" class="block text-center text-gray-500 mt-4 hover:text-green-800">Xóa bộ lọc</a>
                    </form>
                </div>
            </div>

            <!-- Room Grid -->
            <div class="lg:col-span-3">
                <div class="flex justify-between items-center mb-8">
                    <p class="text-gray-500">Hiển thị <strong>{{ $rooms->count() }}</strong> phòng</p>
                    <select class="booking-input w-auto" onchange="window.location.href=this.value">
                        <option>Sắp xếp theo</option>
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}">Giá: Thấp đến cao</option>
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}">Giá: Cao đến thấp</option>
                    </select>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    @forelse($rooms as $room)
                    <div class="room-card">
                        <div class="room-card-image">
                            <img src="{{ $room->image ?? 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=1074&q=80' }}"
                                alt="{{ $room->name }}">
                            @if($room->roomType)
                            <span class="room-card-badge">{{ $room->roomType->name }}</span>
                            @endif
                        </div>
                        <div class="room-card-content">
                            <h3 class="room-card-title">{{ $room->name }}</h3>
                            <p class="text-gray-500 text-sm mb-4">
                                <span class="inline-flex items-center gap-1">
                                    <i data-lucide="users" class="w-4 h-4"></i>
                                    {{ $room->capacity ?? 2 }} Khách
                                </span>
                                <span class="mx-2">•</span>
                                <span class="inline-flex items-center gap-1">
                                    <i data-lucide="maximize" class="w-4 h-4"></i>
                                    {{ $room->area ?? 35 }}m²
                                </span>
                            </p>
                            <div class="flex items-center justify-between">
                                <p class="room-card-price">
                                    {{ number_format($room->price) }}đ <span>/ đêm</span>
                                </p>
                                <a href="{{ route('rooms.show', $room) }}" class="btn-secondary text-sm py-2 px-4">
                                    Chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 text-center py-12">
                        <i data-lucide="search-x" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Không tìm thấy phòng</h3>
                        <p class="text-gray-500 mb-4">Vui lòng thử lại với bộ lọc khác.</p>
                        <a href="{{ route('rooms.index') }}" class="btn-secondary">Xem tất cả phòng</a>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $rooms->links() }}
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