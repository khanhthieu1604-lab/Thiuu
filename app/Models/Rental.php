<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'start_date',
        'end_date',
        'total_days',
        'total_price',
        'status',
    ];

    // Đơn thuê thuộc về user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Đơn thuê thuộc về xe
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Thanh toán (morph)
    public function payment()
    {
        return $this->morphOne(Payment::class, 'payable');
    }
}
