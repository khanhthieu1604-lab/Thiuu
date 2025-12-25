<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'vehicle_id', 
        'start_date', 
        'end_date', 
        'total_price', 
        'status', 
        'note'
    ];

    /**
     * Tự động ép kiểu dữ liệu ngày tháng
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];

    /**
     * Liên kết với Xe (Một đơn đặt thuộc về một xe)
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Liên kết với Người dùng (Một đơn đặt thuộc về một khách hàng)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}