@extends('layouts.app')

@section('title', 'Thuê xe tự lái - Vi vu mọi nẻo đường')

@section('content')

{{-- 1. CSS SỬA LỖI & LÀM ĐẸP --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap');
    
    /* --- FIX LỖI TRÀN VIỀN (QUAN TRỌNG NHẤT) --- */
    /* Đoạn này giúp nội dung phá vỡ container cha để tràn ra 100% màn hình */
    .break-out-container {
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        background-color: #f3f6f8; /* Màu nền xám nhẹ dịu mắt */
        font-family: 'Be Vietnam Pro', sans-serif;
    }

    /* --- FIX LỖI MŨI TÊN KHỔNG LỒ (SVG BUG) --- */
    .pagination svg {
        width: 20px !important;
        height: 20px !important;
    }
    .pagination .page-item {
        margin: 0 2px;
    }
    /* Ẩn dòng chữ "Showing results..." của Laravel nếu thấy vướng */
    .hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between div:first-child {
        display: none;
    }
    nav[role="navigation"] {
        display: flex;
        justify-content: center;
        width: 100%;
    }

    /* --- HERO BANNER --- */
    .hero-section {
        position: relative;
        height: 500px;
        background-image: url('https://images.unsplash.com/photo-1494976388531-d1058494cdd8?q=80&w=2000&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    /* Lớp phủ đen mờ để chữ nổi bật hơn */
    .hero-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.4); /* Đen mờ 40% */
    }

    /* --- CARD DESIGN MỚI (CLEAN) --- */
    .vehicle-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    .vehicle-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08);
    }
    .img-container {
        height: 180px;
        overflow: hidden;
        position: relative;
    }
    .car-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    .vehicle-card:hover .car-img {
        transform: scale(1.1);
    }
    
    /* Tag nổi trên ảnh */
    .price-tag {
        position: absolute;
        bottom: 10px; right: 10px;
        background: rgba(255,255,255,0.95);
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 700;
        color: #000;
        font-size: 0.9rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
</style>

{{-- BẮT ĐẦU VÙNG TRÀN VIỀN --}}
<div class="break-out-container pb-5">

    {{-- 1. HERO BANNER (Đã thêm lớp phủ đen mờ) --}}
    <div class="hero-section mb-5">
        <div class="hero-overlay"></div>
        <div class="container position-relative text-center text-white" style="z-index: 2;">
            <h1 class="display-4 fw-bold mb-3">Tìm xe ưng ý, đi ngay hôm nay</h1>
            <p class="lead mb-4 opacity-75">Hơn 120+ mẫu xe đời mới sẵn sàng phục vụ bạn</p>
            
            <div class="bg-white p-2 rounded-pill shadow-lg d-inline-block w-100" style="max-width: 700px;">
                <form action="{{ route('vehicles.index') }}" method="GET" class="d-flex align-items-center">
                    <i class="fa-solid fa-location-dot text-danger ms-3 fs-5"></i>
                    <input type="text" name="search" class="form-control border-0 shadow-none py-3 px-3 rounded-pill" placeholder="Bạn muốn tìm xe gì? (VD: Mazda, Camry...)" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 fw-bold m-1" style="min-width: 120px;">
                        TÌM XE
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- 2. DANH SÁCH XE (Container-fluid để rộng hơn) --}}
    <div class="container-fluid px-4 px-md-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold m-0 text-dark">
                <i class="fa-solid fa-fire text-warning me-2"></i>Xe đang sẵn sàng
                <span class="text-muted fs-6 fw-normal ms-2">({{ $vehicles->total() }} kết quả)</span>
            </h4>
            
            <form action="{{ route('vehicles.index') }}" method="GET">
                <select name="price" class="form-select border-0 shadow-sm bg-white fw-bold text-secondary rounded-pill ps-3" onchange="this.form.submit()" style="min-width: 180px;">
                    <option value="">-- Mức giá --</option>
                    <option value="under_1m" {{ request('price') == 'under_1m' ? 'selected' : '' }}>Dưới 1 triệu</option>
                    <option value="1m_2m" {{ request('price') == '1m_2m' ? 'selected' : '' }}>Từ 1 - 2 triệu</option>
                    <option value="above_2m" {{ request('price') == 'above_2m' ? 'selected' : '' }}>Trên 2 triệu</option>
                </select>
            </form>
        </div>

        {{-- LƯỚI SẢN PHẨM (Responsive Grid) --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 g-3 g-xl-4">
            @foreach($vehicles as $vehicle)
            <div class="col">
                <div class="vehicle-card shadow-sm">
                    <div class="img-container">
                        <img src="{{ asset($vehicle->image) }}" class="car-img" alt="{{ $vehicle->name }}">
                        <div class="price-tag">
                            {{ number_format($vehicle->rent_price_per_day/1000) }}k
                        </div>
                        <div class="position-absolute top-0 start-0 m-2">
                             <span class="badge bg-dark bg-opacity-50 backdrop-blur rounded-2">{{ $vehicle->brand }}</span>
                        </div>
                    </div>

                    <div class="p-3">
                        <h6 class="fw-bold text-dark text-truncate mb-2" title="{{ $vehicle->name }}">{{ $vehicle->name }}</h6>
                        
                        <div class="d-flex gap-2 mb-3 text-secondary small">
                            <span class="bg-light px-2 py-1 rounded"><i class="fa-solid fa-gears me-1"></i>Tự động</span>
                            <span class="bg-light px-2 py-1 rounded"><i class="fa-solid fa-user-group me-1"></i>5 chỗ</span>
                        </div>

                        <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-outline-primary w-100 btn-sm fw-bold rounded-pill">
                            Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- 3. PHÂN TRANG (Đã fix lỗi mũi tên to) --}}
        <div class="mt-5 d-flex justify-content-center">
            {{-- Gọi view bootstrap-5 cụ thể để tránh lỗi SVG mặc định --}}
            {{ $vehicles->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
        
    </div>
</div>

@endsection