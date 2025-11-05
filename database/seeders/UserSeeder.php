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
            'name' => 'Admin 1',
            'email' => 'admin1@example.com',
            'username' => 'Admin1',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'notelp' => '081234567890',
            'photo' => 'default.jpg',
            'balance' => 0.00,
        ]);

        User::create([
            'name' => 'Admin 2',
            'email' => 'admin2@example.com',
            'username' => 'Admin2',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'notelp' => '081234567890',
            'photo' => 'default.jpg',
            'balance' => 0.00,
        ]);

        User::create([
            'name' => 'Citra Dewi',
            'email' => 'citra@example.com',
            'username' => 'CitraDewi',
            'password' => bcrypt('password123'),
            'role' => 'customer',
            'notelp' => '081234567890',
            'photo' => 'default.jpg',
            'balance' => 500000.00,
        ]);

        User::create([
            'name' => 'Dedi Pratama',
            'email' => 'dedi@example.com',
            'username' => 'DediPratama',
            'password' => bcrypt('password123'),
            'role' => 'customer',
            'notelp' => '081234567890',
            'photo' => 'default.jpg',
            'balance' => 750000.00,
        ]);

        User::create([
            'name' => 'Eka Lestari',
            'email' => 'eka@example.com',
            'username' => 'EkaLestari',
            'password' => bcrypt('password123'),
            'role' => 'customer',
            'notelp' => '081234567890',
            'photo' => 'default.jpg',
            'balance' => 300000.00,
        ]);

        User::create([
            'name' => 'Fajar Setiawan',
            'email' => 'fajar@example.com',
            'username' => 'FajarSetiawan',
            'password' => bcrypt('password123'),
            'role' => 'customer',
            'notelp' => '081234567891',
            'photo' => 'default.jpg',
            'balance' => 600000.00,
        ]);

        User::create([
            'name' => 'Gita Maharani',
            'email' => 'gita@example.com',
            'username' => 'GitaMaharani',
            'password' => bcrypt('password123'),
            'role' => 'customer',
            'notelp' => '081234567892',
            'photo' => 'default.jpg',
            'balance' => 450000.00,
        ]);

        User::create([
            'name' => 'Hendra Wijaya',
            'email' => 'hendra@example.com',
            'username' => 'HendraWijaya',
            'password' => bcrypt('password123'),
            'role' => 'customer',
            'notelp' => '081234567893',
            'photo' => 'default.jpg',
            'balance' => 800000.00,
        ]);

        User::create([
            'name' => 'Indah Permatasari',
            'email' => 'indah@example.com',
            'username' => 'IndahPermatasari',
            'password' => bcrypt('password123'),
            'role' => 'customer',
            'notelp' => '081234567894',
            'photo' => 'default.jpg',
            'balance' => 350000.00,
        ]);

        User::create([
            'name' => 'Joko Santoso',
            'email' => 'joko@example.com',
            'username' => 'JokoSantoso',
            'password' => bcrypt('password123'),
            'role' => 'customer',
            'notelp' => '081234567895',
            'photo' => 'default.jpg',
            'balance' => 900000.00,
        ]);
    }
}
