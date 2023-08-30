<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@admin.com',
            'password' => 'password',
            'name' => 'Admin',
            'email_verified_at' => now(),
            'status' => User::STATUS_ACTIVE
        ]);
    }
}
