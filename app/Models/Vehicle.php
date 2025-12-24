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
    ];

    // Quan hệ: Một xe thuộc về một danh mục
    public function category()
    {
        return $this->belongsTo(VehicleCategory::class, 'category_id');
    }

    // Quan hệ: Một xe có thể có nhiều ảnh (Dựa trên migration vehicle_images)
    public function images()
    {
        return $this->hasMany(VehicleImage::class);
    }

    // Quan hệ: Một xe có thể có nhiều đơn thuê
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    /**
     * Helper: Lấy ảnh đầu tiên của xe làm ảnh đại diện
     */
    public function getThumbnailAttribute()
    {
        $firstImage = $this->images()->first();
        return $firstImage ? asset('storage/' . $firstImage->image_path) : asset('images/default-car.jpg');
    }
}