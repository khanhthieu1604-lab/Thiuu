@extends('layouts.app')

@section('title', 'Tài khoản')

@section('content')
<!-- Page Header -->
<section class="bg-green-900 py-16">
    <div class="container-custom">
        <h1 class="text-3xl font-bold text-white" style="font-family: 'Playfair Display', serif;">Xin chào, {{ auth()->user()->name }}!</h1>
        <p class="text-gray-300 mt-2">Quản lý tài khoản và đặt phòng của bạn</p>
    </div>
</section>

<section class="section">
    <div class="container-custom">
        @php
        $user = auth()->user();
        $bookings = \App\Models\Booking::where('user_id', $user->id)->with(['room.hotel'])->orderBy('created_at', 'desc')->get();
        $upcomingBookings = $bookings->where('check_in', '>=', now())->where('status', '!=', 'cancelled')->take(3);
        $totalBookings = $bookings->count();
        $totalSpent = $bookings->where('status', '!=', 'cancelled')->sum('total_price');
        @endphp

        <!-- Stats Cards -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Tổng đặt phòng</p>
                        <p class="text-3xl font-bold text-green-800">{{ $totalBookings }}</p>
                    </div>
                    <div class="w-14 h-14 bg-green-100 flex items-center justify-center">
                        <i data-lucide="calendar-check" class="w-7 h-7 text-green-800"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Sắp diễn ra</p>
                        <p class="text-3xl font-bold text-amber-600">{{ $upcomingBookings->count() }}</p>
                    </div>
                    <div class="w-14 h-14 bg-amber-100 flex items-center justify-center">
                        <i data-lucide="briefcase" class="w-7 h-7 text-amber-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Tổng chi tiêu</p>
                        <p class="text-3xl font-bold text-green-800">{{ number_format($totalSpent) }}đ</p>
                    </div>
                    <div class="w-14 h-14 bg-green-100 flex items-center justify-center">
                        <i data-lucide="wallet" class="w-7 h-7 text-green-800"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Upcoming Bookings -->
                <div class="bg-white p-6 border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold" style="font-family: 'Playfair Display', serif;">Đặt phòng sắp tới</h2>
                        <a href="{{ route('bookings.index') }}" class="text-green-800 hover:underline text-sm">Xem tất cả →</a>
                    </div>

                    @forelse($upcomingBookings as $booking)
                    <div class="flex gap-4 p-4 border-b last:border-b-0">
                        <img src="{{ $booking->room->image ?? 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80' }}"
                            alt="{{ $booking->room->name ?? 'Room' }}"
                            class="w-24 h-20 object-cover flex-shrink-0">
                        <div class="flex-1">
                            <h4 class="font-semibold">{{ $booking->room->name ?? 'Phòng' }}</h4>
                            <p class="text-sm text-gray-500 mb-2">{{ $booking->room->hotel->name ?? 'KThiuu Hotel' }}</p>
                            <p class="text-sm">
                                <i data-lucide="calendar" class="w-4 h-4 inline"></i>
                                {{ \Carbon\Carbon::parse($booking->check_in)->format('d/m') }} - {{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') }}
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-2 py-1 text-xs font-semibold bg-green-100 text-green-800">
                                {{ $booking->status === 'confirmed' ? 'Đã xác nhận' : 'Chờ xử lý' }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-500">
                        <i data-lucide="calendar-x" class="w-12 h-12 mx-auto mb-3 opacity-50"></i>
                        <p>Chưa có đặt phòng sắp tới</p>
                        <a href="{{ route('rooms.index') }}" class="btn-primary mt-4 inline-block">Đặt phòng ngay</a>
                    </div>
                    @endforelse
                </div>

                <!-- Recent Activity -->
                @if($bookings->count() > 0)
                <div class="bg-white p-6 border border-gray-100">
                    <h2 class="text-xl font-semibold mb-6" style="font-family: 'Playfair Display', serif;">Lịch sử gần đây</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-3 px-2 text-sm font-semibold text-gray-600">Phòng</th>
                                    <th class="text-left py-3 px-2 text-sm font-semibold text-gray-600">Ngày</th>
                                    <th class="text-left py-3 px-2 text-sm font-semibold text-gray-600">Tổng tiền</th>
                                    <th class="text-left py-3 px-2 text-sm font-semibold text-gray-600">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings->take(5) as $booking)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-2">
                                        <p class="font-semibold">{{ $booking->room->name ?? 'Phòng' }}</p>
                                    </td>
                                    <td class="py-3 px-2 text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}
                                    </td>
                                    <td class="py-3 px-2 font-semibold">{{ number_format($booking->total_price) }}đ</td>
                                    <td class="py-3 px-2">
                                        @php
                                        $colors = ['confirmed' => 'bg-green-100 text-green-800', 'pending' => 'bg-yellow-100 text-yellow-800', 'cancelled' => 'bg-red-100 text-red-800'];
                                        $texts = ['confirmed' => 'Xác nhận', 'pending' => 'Chờ xử lý', 'cancelled' => 'Đã hủy'];
                                        @endphp
                                        <span class="text-xs font-semibold px-2 py-1 {{ $colors[$booking->status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ $texts[$booking->status] ?? $booking->status }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold mb-4" style="font-family: 'Playfair Display', serif;">Thao tác nhanh</h3>
                    <div class="space-y-3">
                        <a href="{{ route('rooms.index') }}" class="flex items-center gap-3 p-3 border hover:border-green-500 hover:bg-green-50 transition">
                            <i data-lucide="search" class="w-5 h-5 text-green-800"></i>
                            <span>Tìm phòng</span>
                        </a>
                        <a href="{{ route('bookings.index') }}" class="flex items-center gap-3 p-3 border hover:border-green-500 hover:bg-green-50 transition">
                            <i data-lucide="list" class="w-5 h-5 text-green-800"></i>
                            <span>Lịch sử đặt phòng</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-3 border hover:border-green-500 hover:bg-green-50 transition">
                            <i data-lucide="user" class="w-5 h-5 text-green-800"></i>
                            <span>Chỉnh sửa hồ sơ</span>
                        </a>
                        <a href="{{ route('contact') }}" class="flex items-center gap-3 p-3 border hover:border-green-500 hover:bg-green-50 transition">
                            <i data-lucide="headphones" class="w-5 h-5 text-green-800"></i>
                            <span>Hỗ trợ</span>
                        </a>
                    </div>
                </div>

                <!-- Account Info -->
                <div class="bg-white p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold mb-4" style="font-family: 'Playfair Display', serif;">Thông tin tài khoản</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500">Họ tên</p>
                            <p class="font-semibold">{{ $user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-semibold">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Thành viên từ</p>
                            <p class="font-semibold">{{ $user->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
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