@extends('layouts.app')

@section('title', 'Danh sách xe')

@section('content')

<section class="vehicle-section">
    <h2 class="section-title">🚘 Danh sách xe cho thuê</h2>

    <div class="vehicle-grid">
        @foreach ($vehicles as $vehicle)
            <div class="vehicle-card">

                {{-- FAKE IMAGE --}}
                <div class="vehicle-image">
                    <span>{{ $vehicle->brand }}</span>
                </div>

                <div class="vehicle-body">
                    <h3>{{ $vehicle->name }}</h3>

                    <div class="vehicle-meta">
                        {{ $vehicle->category->name ?? 'N/A' }} • {{ $vehicle->brand }}
                    </div>

                    <div class="vehicle-price">
                        {{ number_format($vehicle->rent_price_per_day) }} / ngày
                    </div>

                    <a href="{{ route('vehicles.show', $vehicle->id) }}" class="detail-link">
                        Xem chi tiết →
                    </a>
                </div>

            </div>
        @endforeach
    </div>
</section>

@endsection
