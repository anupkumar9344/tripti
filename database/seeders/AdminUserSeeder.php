<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Creates the default admin user for the panel.
 */
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@tripti.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Tripti@2026'),
                'is_admin' => true,
                'status' => true,
            ]
        );
    }
}
