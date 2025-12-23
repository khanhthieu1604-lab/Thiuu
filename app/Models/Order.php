<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'price',
        'status',
    ];

    // Đơn mua thuộc về user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Đơn mua thuộc về xe
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
