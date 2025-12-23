@extends('layouts.app')

@section('title', $vehicle->name)

@section('content')

<section class="vehicle-detail">

    {{-- HERO --}}
    <div class="detail-hero">
        <div class="detail-hero-text">
            <h1>{{ $vehicle->name }}</h1>

            <p class="detail-meta">
                🚘 {{ $vehicle->category->name ?? 'N/A' }} • {{ $vehicle->brand }}
            </p>

            <div class="detail-price">
                {{ number_format($vehicle->rent_price_per_day) }} / ngày
            </div>

            <div class="detail-actions">
                <a href="#rent-box" class="btn-primary">📅 Thuê xe ngay</a>
                <a href="{{ route('vehicles.index') }}" class="btn-outline">⬅ Quay lại</a>
            </div>
        </div>

        {{-- FAKE IMAGE --}}
        <div class="detail-hero-image">
            <span>{{ $vehicle->brand }}</span>
        </div>
    </div>

    {{-- INFO --}}
    <div class="detail-info">
        <div class="info-box">
            <h3>Mô tả xe</h3>
            <p>
                {{ $vehicle->description ?? 'Xe được bảo dưỡng định kỳ, sạch sẽ, phù hợp đi gia đình và công việc.' }}
            </p>
        </div>

        <div class="info-box">
            <h3>Thông tin nhanh</h3>
            <ul>
                <li>✔ Giá minh bạch, không phụ phí</li>
                <li>✔ Thủ tục nhanh gọn</li>
                <li>✔ Hỗ trợ 24/7</li>
                <li>✔ Giao xe tận nơi</li>
            </ul>
        </div>
    </div>

    {{-- RENT FORM --}}
    <div id="rent-box" class="rent-box">
        <h2>📅 Đặt lịch thuê xe</h2>

        <form method="POST" action="{{ route('rentals.store', $vehicle->id) }}">
            @csrf

            <div class="rent-grid">
                <div>
                    <label>Ngày bắt đầu</label>
                    <input type="date" name="start_date" required>
                </div>

                <div>
                    <label>Ngày kết thúc</label>
                    <input type="date" name="end_date" required>
                </div>
            </div>

            <button type="submit" class="btn-primary full">
                🚗 Xác nhận thuê xe
            </button>
        </form>
    </div>

</section>

@endsection
