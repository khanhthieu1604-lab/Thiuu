<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Luxury, Grand, Holiday, Standard
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Add room_type_id to existing rooms table
        Schema::table('hotel_rooms', function (Blueprint $table) {
            $table->foreignId('room_type_id')->nullable()->after('hotel_id')->constrained('room_types')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('hotel_rooms', function (Blueprint $table) {
            $table->dropForeign(['room_type_id']);
            $table->dropColumn('room_type_id');
        });
        Schema::dropIfExists('room_types');
    }
};
