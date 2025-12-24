<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'vehicle_id', 'start_date', 'end_date', 'total_price', 'status', 'note'
    ];

    // Liên kết với Xe
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Liên kết với Người dùng (Khách hàng)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}