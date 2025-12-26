<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'brand',
        'model',
        'year',
        'rent_price_per_day',
        'sale_price',
        'is_for_rent',  
        'is_for_sale',
        'description',
        'status',
        'image', // Đảm bảo trường này có trong fillable để lưu đường dẫn ảnh
    ];

    // Quan hệ: Một xe thuộc về một danh mục
    public function category()
    {
        return $this->belongsTo(VehicleCategory::class, 'category_id');
    }

    // Quan hệ: Một xe có thể có nhiều ảnh (Gallery)
    public function images()
    {
        return $this->hasMany(VehicleImage::class);
    }

    // Quan hệ: Một xe có thể có nhiều đơn thuê
    public function rentals() // Hoặc bookings tùy theo bạn dùng cái nào chính
    {
        return $this->hasMany(Rental::class);
    }

    // Quan hệ: Booking (Mới thêm để đồng bộ với BookingController)
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Helper: Lấy ảnh đại diện
     */
    public function getThumbnailAttribute()
    {
        if ($this->image) {
            return asset($this->image);
        }
        $firstImage = $this->images()->first();
        return $firstImage ? asset('storage/' . $firstImage->image_path) : asset('images/default-car.jpg');
    }

    // --- QUAN TRỌNG: Hàm này đang bị thiếu gây ra lỗi ---
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
}