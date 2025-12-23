<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('rentals', function (Blueprint $table) {
        $table->id();
        
        // Khóa ngoại liên kết xe
        $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
        
        // Khóa ngoại liên kết người dùng (Tạm thời để nullable hoặc hardcode user_id=1 vì chưa làm đăng nhập)
        // Sau này làm Phase 3 (Auth) thì bỏ ->nullable() đi
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); 
        
        $table->date('start_date');
        $table->date('end_date');
        
        // Tổng tiền (Lưu số lớn)
        $table->decimal('total_price', 15, 2);
        
        // Trạng thái đơn: pending (chờ duyệt), approved (đã duyệt), completed (đã trả xe), cancelled
        $table->string('status')->default('pending');
        
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};