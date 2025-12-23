<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'payment_method',
    ];

    // Thanh toán thuộc về user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Morph: rental hoặc order
    public function payable()
    {
        return $this->morphTo();
    }
}
