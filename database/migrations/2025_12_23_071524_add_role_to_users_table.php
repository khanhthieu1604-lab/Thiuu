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
    Schema::table('users', function (Blueprint $table) {
        // Thêm cột role: mặc định là 'customer', có thể là 'admin'
        $table->string('role')->default('customer')->after('email'); 
        $table->string('phone')->nullable()->after('role'); // Thêm SĐT luôn cho giống báo cáo
        $table->string('address')->nullable()->after('phone');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['role', 'phone', 'address']);
    });
}
};
