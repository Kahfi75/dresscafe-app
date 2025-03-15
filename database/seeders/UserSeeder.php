<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin Qmartz',
                'email' => 'admin@qmartz.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kasir Qmartz',
                'email' => 'kasir@qmartz.com',
                'password' => Hash::make('kasir123'),
                'role' => 'kasir',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
