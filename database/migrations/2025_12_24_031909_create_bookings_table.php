<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Khách hàng
        $table->foreignId('vehicle_id')->constrained()->onDelete('cascade'); // Xe được thuê
        $table->date('start_date'); // Ngày bắt đầu
        $table->date('end_date');   // Ngày kết thúc
        $table->decimal('total_price', 15, 2); // Tổng tiền
        $table->string('status')->default('pending'); // pending, confirmed, completed, cancelled
        $table->text('note')->nullable(); // Ghi chú thêm
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
