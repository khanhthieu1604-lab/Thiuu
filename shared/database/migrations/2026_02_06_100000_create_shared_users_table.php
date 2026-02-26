<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Unified Users Table for Thiuu Ecosystem SSO
 * 
 * This table is shared between:
 * - Thiuu CarRental (:8000)
 * - KThiuu Hotel (:8001)
 */
return new class extends Migration
{
    protected $connection = 'shared_auth';

    public function up(): void
    {
        Schema::connection($this->connection)->create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('customer');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();

            // App-specific permissions
            $table->json('app_permissions')->nullable()->comment('{"car_rental": true, "hotel": true}');

            $table->rememberToken();
            $table->timestamps();

            // Indexes
            $table->index('role');
            $table->index('email_verified_at');
        });

        Schema::connection($this->connection)->create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::connection($this->connection)->create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });

        // SSO tokens for cross-app authentication
        Schema::connection($this->connection)->create('sso_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('token', 64)->unique();
            $table->string('source_app')->comment('car_rental or hotel');
            $table->string('target_app')->comment('car_rental or hotel');
            $table->timestamp('expires_at');
            $table->timestamp('used_at')->nullable();
            $table->timestamps();

            $table->index(['token', 'expires_at']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('sso_tokens');
        Schema::connection($this->connection)->dropIfExists('personal_access_tokens');
        Schema::connection($this->connection)->dropIfExists('password_reset_tokens');
        Schema::connection($this->connection)->dropIfExists('users');
    }
};
