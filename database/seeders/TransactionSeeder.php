<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'order_number' => 'ORD-0001',
            'customer_id' => 1, // Andi Saputra
            'book_id' => 2, // Harry Potter
            'total_amount' => 150000.00,
        ]);

        Transaction::create([
            'order_number' => 'ORD-0002',
            'customer_id' => 2, // Budi Santoso
            'book_id' => 1, // Murder on the Orient Express
            'total_amount' => 120000.00,
        ]);

        Transaction::create([
            'order_number' => 'ORD-0003',
            'customer_id' => 4, // Dedi Pratama
            'book_id' => 4, // Laskar Pelangi
            'total_amount' => 95000.00,
        ]);

        Transaction::create([
            'order_number' => 'ORD-0004',
            'customer_id' => 1, // Andi Saputra
            'book_id' => 5, // 1984
            'total_amount' => 110000.00,
        ]);

        Transaction::create([
            'order_number' => 'ORD-0005',
            'customer_id' => 2, // Budi Santoso
            'book_id' => 3, // The Shining
            'total_amount' => 135000.00,
        ]);
    }
}
