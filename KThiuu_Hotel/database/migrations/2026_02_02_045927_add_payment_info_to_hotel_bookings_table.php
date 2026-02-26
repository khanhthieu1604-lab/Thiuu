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
        Schema::table('hotel_bookings', function (Blueprint $table) {
            $table->decimal('total_price', 10, 2)->after('status');
            $table->string('payment_status')->default('pending')->after('total_price'); // pending, paid, failed, refunded
            $table->string('payment_method')->default('cod')->after('payment_status'); // cod, vnpay, mo_mo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotel_bookings', function (Blueprint $table) {
            $table->dropColumn(['total_price', 'payment_status', 'payment_method']);
        });
    }
};
