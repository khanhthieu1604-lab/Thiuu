@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Thêm xe mới vào hệ thống</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Tên xe</label>
                    <input type="text" name="name" class="form-control" placeholder="VD: Toyota Camry 2024" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Hãng xe</label>
                    <input type="text" name="brand" class="form-control" placeholder="VD: Toyota" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Giá thuê/ngày (VNĐ)</label>
                    <input type="number" name="price" class="form-control" placeholder="VD: 1200000" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Hình ảnh xe</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Lưu xe</button>
                    <a href="{{ route('admin.vehicles.index') }}" class="btn btn-light px-4">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection