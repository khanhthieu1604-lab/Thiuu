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
     * Đã bao gồm 'role', 'phone', 'address'
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',    // Phân quyền: admin hoặc user
        'phone',   // Số điện thoại
        'address', // Địa chỉ
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
     * Hàm này được dùng trong AdminMiddleware và blade
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Kiểm tra xem user có phải Khách hàng không (tùy chọn)
     */
    public function isCustomer()
    {
        return $this->role === 'customer' || $this->role === 'user';
    }

    /* =======================
        RELATIONSHIPS (QUAN HỆ)
       Dựa trên cấu trúc database đã tạo
    ======================= */

    // User có nhiều đơn thuê xe
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    // User có nhiều đơn mua xe (nếu có tính năng bán)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // User có nhiều lịch sử thanh toán
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}