<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    // Danh sách các cột được phép ghi dữ liệu vào
    protected $fillable = [
        'vehicle_id',
        'user_id',
        'start_date',
        'end_date',
        'total_days', // <--- Quan trọng: Phải có cái này mới lưu được số ngày
        'total_price',
        'status'
    ];

    // Quan hệ: Đơn thuê thuộc về 1 chiếc xe
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Quan hệ: Đơn thuê thuộc về 1 người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}