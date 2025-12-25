<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Các thuộc tính có thể gán hàng loạt (Mass Assignable).
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',    // Phân quyền: admin hoặc user
        'phone',   // Số điện thoại (MỚI)
        'address', // Địa chỉ (MỚI)
        'avatar',  // Ảnh đại diện (MỚI)
    ];

    /**
     * Các thuộc tính cần ẩn khi trả về JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Định dạng kiểu dữ liệu.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* =======================
        PHÂN QUYỀN (HELPER METHODS)
    ======================= */

    /**
     * Kiểm tra xem user có phải là Admin không
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Kiểm tra xem user có phải Khách hàng không
     */
    public function isCustomer()
    {
        return $this->role === 'customer' || $this->role === 'user' || $this->role === null;
    }

    /* =======================
        RELATIONSHIPS (QUAN HỆ)
    ======================= */

    // User có nhiều đơn đặt xe (Sửa từ rentals -> bookings)
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // User có nhiều lịch sử thanh toán
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}