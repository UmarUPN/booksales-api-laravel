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
            'name' => 'Andi Saputra',
            'email' => 'andi@example.com',
            'password' => bcrypt('password123'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => bcrypt('password123'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Citra Dewi',
            'email' => 'citra@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Dedi Pratama',
            'email' => 'dedi@example.com',
            'password' => bcrypt('password123'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Eka Lestari',
            'email' => 'eka@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);
    }
}
