<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Các thuộc tính có thể gán hàng loạt (Mass Assignable).
     * Đã thêm 'role', 'phone', 'address' theo báo cáo chức năng[cite: 1, 10, 11].
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',    // Phân quyền: admin hoặc customer [cite: 11]
        'phone',   // Lưu trữ thông tin khách hàng [cite: 18]
        'address', // Lưu trữ thông tin khách hàng [cite: 18]
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
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
       Dựa trên mục 2 & 3 của báo cáo [cite: 7, 11]
    ======================= */

    // Kiểm tra xem user có phải Admin không
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Kiểm tra xem user có phải Khách hàng không
    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    /* =======================
        RELATIONSHIPS
       Dựa trên mục 6 của báo cáo [cite: 20]
    ======================= */

    // User có nhiều đơn thuê xe (Hợp đồng) [cite: 21]
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    // User có nhiều đơn mua xe
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // User có nhiều thanh toán
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}