@extends('layouts.app')

@section('title', 'Lịch sử đặt phòng')
@section('description', 'Xem lịch sử đặt phòng của bạn tại KThiuu Hotel')

@section('content')
<!-- Page Header -->
<section class="bg-green-900 py-16">
    <div class="container-custom">
        <h1 class="text-3xl font-bold text-white" style="font-family: 'Playfair Display', serif;">Lịch sử đặt phòng</h1>
        <p class="text-gray-300 mt-2">Quản lý các đơn đặt phòng của bạn</p>
    </div>
</section>

<section class="section">
    <div class="container-custom">
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-6 flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-6 flex items-center gap-3">
            <i data-lucide="alert-circle" class="w-5 h-5"></i>
            {{ session('error') }}
        </div>
        @endif

        @forelse($bookings as $booking)
        <div class="bg-white border border-gray-100 p-6 mb-4">
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Room Image -->
                <div class="lg:w-48 flex-shrink-0">
                    <img src="{{ $booking->room->image ?? 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }}"
                        alt="{{ $booking->room->name ?? 'Room' }}"
                        class="w-full h-32 lg:h-full object-cover">
                </div>

                <!-- Booking Info -->
                <div class="flex-1">
                    <div class="flex flex-wrap justify-between items-start gap-4 mb-4">
                        <div>
                            <h3 class="text-xl font-semibold" style="font-family: 'Playfair Display', serif;">
                                {{ $booking->room->name ?? 'Phòng đã xóa' }}
                            </h3>
                            <p class="text-gray-500 text-sm">{{ $booking->room->hotel->name ?? 'KThiuu Hotel' }}</p>
                        </div>
                        <div class="text-right">
                            @php
                            $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'confirmed' => 'bg-green-100 text-green-800',
                            'cancelled' => 'bg-red-100 text-red-800',
                            'completed' => 'bg-blue-100 text-blue-800',
                            ];
                            $statusText = [
                            'pending' => 'Chờ xác nhận',
                            'confirmed' => 'Đã xác nhận',
                            'cancelled' => 'Đã hủy',
                            'completed' => 'Hoàn thành',
                            ];
                            @endphp
                            <span class="inline-block px-3 py-1 text-sm font-semibold {{ $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $statusText[$booking->status] ?? $booking->status }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                        <div>
                            <p class="text-gray-500 text-sm">Mã đặt phòng</p>
                            <p class="font-semibold">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Nhận phòng</p>
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Trả phòng</p>
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Tổng tiền</p>
                            <p class="font-semibold text-green-800">{{ number_format($booking->total_price) }}đ</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        @if($booking->room)
                        <a href="{{ route('rooms.show', $booking->room) }}" class="btn-secondary text-sm py-2 px-4">
                            Xem phòng
                        </a>
                        @endif
                        @if($booking->status === 'pending' || $booking->status === 'confirmed')
                        <form action="{{ route('bookings.cancel', $booking) }}" method="POST" class="inline"
                            onsubmit="return confirm('Bạn có chắc muốn hủy đặt phòng này?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-red-50 text-red-600 border border-red-200 py-2 px-4 text-sm hover:bg-red-100 transition-colors">
                                Hủy đặt phòng
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-16">
            <i data-lucide="calendar-x" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Chưa có đặt phòng</h3>
            <p class="text-gray-500 mb-6">Bạn chưa có lịch sử đặt phòng nào.</p>
            <a href="{{ route('rooms.index') }}" class="btn-primary">Khám phá phòng nghỉ</a>
        </div>
        @endforelse
    </div>
</section>
@endsection

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush