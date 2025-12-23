<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // Người thực hiện thanh toán
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Liên kết đa hình: rental hoặc order
            $table->morphs('payable'); 
            // tạo 2 cột: payable_type, payable_id

            // Thông tin thanh toán
            $table->decimal('amount', 12, 2);
            $table->enum('status', [
                'pending',   // chưa thanh toán
                'paid',      // đã thanh toán
                'failed'     // thất bại
            ])->default('pending');

            // Thanh toán mô phỏng
            $table->string('payment_method')->default('mock');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
