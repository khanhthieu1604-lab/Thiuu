@extends('layouts.app')

@section('title', $vehicle->name)

@section('content')

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('vehicles.index') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $vehicle->name }}</li>
    </ol>
</nav>

<div class="row g-5">
    
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4 overflow-hidden rounded-4">
            <img src="https://images.unsplash.com/photo-1503376763036-066120622c74?auto=format&fit=crop&w=1200&q=80" 
                 class="img-fluid w-100" 
                 alt="{{ $vehicle->name }}" 
                 style="max-height: 500px; object-fit: cover;">
        </div>

        <div class="mb-4">
            <h1 class="fw-bold mb-2">{{ $vehicle->name }}</h1>
            <div class="d-flex align-items-center gap-3 text-muted">
                <span><i class="fa-solid fa-tag text-primary"></i> {{ $vehicle->brand }}</span>
                <span><i class="fa-solid fa-car text-primary"></i> {{ $vehicle->category->name ?? 'Sedan' }}</span>
                <span><i class="fa-solid fa-star text-warning"></i> 5.0 (24 đánh giá)</span>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-4 mb-4 rounded-4">
            <h4 class="fw-bold mb-3">Mô tả xe</h4>
            <p class="text-secondary leading-relaxed">
                {{ $vehicle->description ?? 'Xe đời mới, nội thất sạch sẽ, được bảo dưỡng định kỳ tại hãng. Trang bị đầy đủ màn hình Android, Camera hành trình, Camera lùi. Phù hợp cho gia đình đi du lịch hoặc gặp gỡ đối tác.' }}
            </p>
            
            <h5 class="fw-bold mt-4 mb-3">Tiện nghi</h5>
            <div class="row g-3">
                <div class="col-6 col-md-4"><i class="fa-solid fa-check text-success me-2"></i> Bản đồ</div>
                <div class="col-6 col-md-4"><i class="fa-solid fa-check text-success me-2"></i> Bluetooth</div>
                <div class="col-6 col-md-4"><i class="fa-solid fa-check text-success me-2"></i> Camera lùi</div>
                <div class="col-6 col-md-4"><i class="fa-solid fa-check text-success me-2"></i> Cảnh báo tốc độ</div>
                <div class="col-6 col-md-4"><i class="fa-solid fa-check text-success me-2"></i> Lốp dự phòng</div>
                <div class="col-6 col-md-4"><i class="fa-solid fa-check text-success me-2"></i> Khe cắm USB</div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-lg rounded-4 p-4 sticky-top" style="top: 100px; z-index: 10;">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <span class="text-muted small text-uppercase fw-bold">Giá thuê</span>
                    <h2 class="text-primary fw-bold mb-0">{{ number_format($vehicle->rent_price_per_day) }}đ</h2>
                </div>
                <span class="text-muted">/ngày</span>
            </div>

            <hr class="text-muted opacity-25">

            @if ($errors->any())
                <div class="alert alert-danger mb-3 border-0 bg-danger bg-opacity-10 text-danger">
                    <ul class="mb-0 ps-3 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success mb-3 border-0 bg-success bg-opacity-10 text-success">
                    <i class="fa-solid fa-check-circle me-1"></i> {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger mb-3 border-0 bg-danger bg-opacity-10 text-danger">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i> {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('rentals.store', $vehicle->id) }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold small text-uppercase">Ngày nhận xe</label>
                    <input type="date" name="start_date" class="form-control form-control-lg bg-light border-0" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold small text-uppercase">Ngày trả xe</label>
                    <input type="date" name="end_date" class="form-control form-control-lg bg-light border-0" required>
                </div>

                <div class="d-flex justify-content-between mb-2 small">
                    <span class="text-muted">Đơn giá / ngày</span>
                    <span class="fw-bold">{{ number_format($vehicle->rent_price_per_day) }} ₫</span>
                </div>
                
                <div class="d-flex justify-content-between mb-4 fw-bold align-items-center">
                    <span>Tổng cộng (Dự kiến)</span>
                    <span class="text-primary fs-4" id="total-price">0 ₫</span>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold shadow-sm" disabled>
                    <i class="fa-solid fa-bolt me-2"></i> XÁC NHẬN THUÊ XE
                </button>
                <p class="text-center mt-3 text-muted small mb-0">Chưa thu tiền ngay • Hủy miễn phí</p>
            </form>
        </div>
    </div>

</div>

{{-- SCRIPT TÍNH TIỀN (ĐẶT TRỰC TIẾP TẠI ĐÂY ĐỂ CHẮC CHẮN CHẠY) --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("Script tính tiền đã chạy!"); // Kiểm tra trong Console F12

        // 1. Lấy các phần tử cần thiết
        const startDateInput = document.querySelector('input[name="start_date"]');
        const endDateInput = document.querySelector('input[name="end_date"]');
        const pricePerDay = {{ $vehicle->rent_price_per_day }}; 
        
        const totalPriceEl = document.getElementById('total-price');
        const btnSubmit = document.querySelector('button[type="submit"]');

        // Hàm định dạng tiền tệ Việt Nam
        const formatCurrency = (amount) => {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
        }

        // 2. Hàm tính toán
        function calculateTotal() {
            const startStr = startDateInput.value;
            const endStr = endDateInput.value;

            // Chỉ tính khi user đã chọn cả 2 ngày
            if (startStr && endStr) {
                const start = new Date(startStr);
                const end = new Date(endStr);

                // Tính khoảng cách thời gian
                const diffTime = end - start;
                // Quy đổi ra ngày
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                console.log("Số ngày:", diffDays); // Debug

                if (diffDays > 0) {
                    const total = diffDays * pricePerDay;
                    
                    // Cập nhật giao diện
                    if(totalPriceEl) totalPriceEl.innerText = formatCurrency(total);
                    
                    btnSubmit.disabled = false; // Mở khóa nút thuê
                    btnSubmit.innerHTML = '<i class="fa-solid fa-bolt me-2"></i> XÁC NHẬN THUÊ XE';
                } else {
                    if(totalPriceEl) totalPriceEl.innerText = '0 ₫';
                    btnSubmit.disabled = true; // Khóa nút
                    btnSubmit.innerText = 'Ngày trả phải sau ngày nhận';
                }
            }
        }

        // 3. Gắn sự kiện thay đổi
        if(startDateInput) startDateInput.addEventListener('change', calculateTotal);
        if(endDateInput) endDateInput.addEventListener('change', calculateTotal);
    });
</script>

@endsection