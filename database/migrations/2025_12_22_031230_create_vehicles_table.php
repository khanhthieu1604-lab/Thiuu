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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            // Quan hệ
            $table->foreignId('category_id')
                  ->constrained('vehicle_categories')
                  ->cascadeOnDelete();

            // Thông tin xe
            $table->string('name');           // Tên xe
            $table->string('brand');          // Hãng xe
            $table->string('model');          // Dòng xe
            $table->integer('year');          // Năm sản xuất

            // Giá
            $table->decimal('rent_price_per_day', 12, 2)->nullable(); // Giá thuê/ngày
            $table->decimal('sale_price', 12, 2)->nullable();         // Giá bán

            // Trạng thái kinh doanh
            $table->boolean('is_for_rent')->default(true);
            $table->boolean('is_for_sale')->default(false);

            // Mô tả & trạng thái
            $table->text('description')->nullable();
            $table->enum('status', ['available', 'rented', 'sold'])->default('available');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
