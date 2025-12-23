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
    Schema::create('vehicles', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('brand');
        $table->text('description')->nullable();
        $table->decimal('rent_price_per_day', 10, 2);
        $table->string('image')->nullable(); // Cột này sẽ chứa link ảnh
        $table->string('status')->default('available');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('vehicles'); // <--- SỬA LẠI TÊN BẢNG CHO ĐÚNG
}
};
