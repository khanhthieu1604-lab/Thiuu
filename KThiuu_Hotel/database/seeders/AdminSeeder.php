<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if role column exists, if not, we can't seed role
        if (!Schema::hasColumn('users', 'role')) {
            $this->command->error('Role column does not exist in users table. Please add it manually or run migrations if applicable.');
            return;
        }

        User::updateOrCreate(
            ['email' => 'admin@thiuu.com'],
            [
                'name' => 'Thiuu Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
