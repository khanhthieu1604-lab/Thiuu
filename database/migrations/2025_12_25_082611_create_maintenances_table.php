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
    Schema::create('maintenances', function (Blueprint $table) {
        $table->id();
        $table->foreignId('vehicle_id')->constrained()->onDelete('cascade'); // Gắn với xe nào
        $table->string('type'); // Loại: 'Bảo dưỡng định kỳ', 'Sửa chữa', 'Đăng kiểm', 'Thay dầu'
        $table->decimal('cost', 12, 2); // Chi phí
        $table->text('description')->nullable(); // Chi tiết: Thay lốp, sơn lại cửa...
        $table->date('maintenance_date'); // Ngày thực hiện
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
