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
        Schema::table('hotel_rooms', function (Blueprint $table) {
            // Add name column if not exists
            if (!Schema::hasColumn('hotel_rooms', 'name')) {
                $table->string('name')->after('hotel_id');
            }

            // Add area column if not exists
            if (!Schema::hasColumn('hotel_rooms', 'area')) {
                $table->integer('area')->nullable()->after('capacity');
            }

            // Add bed_type column if not exists
            if (!Schema::hasColumn('hotel_rooms', 'bed_type')) {
                $table->string('bed_type')->nullable()->after('area');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotel_rooms', function (Blueprint $table) {
            $table->dropColumn(['name', 'area', 'bed_type']);
        });
    }
};
