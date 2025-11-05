<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\TransactionItem;

class TransactionItemSeeder extends Seeder
{
    public function run(): void
    {
        $transactions = Transaction::all();

        if ($transactions->count() < 5) {
            $this->command->warn('⚠️ Harap jalankan TransactionSeeder terlebih dahulu.');
            return;
        }

        $t1 = $transactions[0];
        $t2 = $transactions[1];
        $t3 = $transactions[2];
        $t4 = $transactions[3];
        $t5 = $transactions[4];

        // === Transaksi 1 ===
        TransactionItem::create([
            'transaction_id' => $t1->id,
            'book_id' => 1,
            'quantity' => 1,
            'price' => 120000.00,
            'book_title' => 'Murder on the Orient Express',
            'author_name' => 'Agatha Christie',
        ]);
        TransactionItem::create([
            'transaction_id' => $t1->id,
            'book_id' => 2,
            'quantity' => 1,
            'price' => 150000.00,
            'book_title' => "Harry Potter and the Sorcerer's Stone",
            'author_name' => 'J.K. Rowling',
        ]);
        TransactionItem::create([
            'transaction_id' => $t1->id,
            'book_id' => 3,
            'quantity' => 1,
            'price' => 135000.00,
            'book_title' => 'The Shining',
            'author_name' => 'Stephen King',
        ]);

        // === Transaksi 2 ===
        TransactionItem::create([
            'transaction_id' => $t2->id,
            'book_id' => 2,
            'quantity' => 1,
            'price' => 150000.00,
            'book_title' => "Harry Potter and the Sorcerer's Stone",
            'author_name' => 'J.K. Rowling',
        ]);
        TransactionItem::create([
            'transaction_id' => $t2->id,
            'book_id' => 4,
            'quantity' => 2,
            'price' => 95000.00,
            'book_title' => 'Laskar Pelangi',
            'author_name' => 'Andrea Hirata',
        ]);
        TransactionItem::create([
            'transaction_id' => $t2->id,
            'book_id' => 5,
            'quantity' => 1,
            'price' => 110000.00,
            'book_title' => '1984',
            'author_name' => 'George Orwell',
        ]);

        // === Transaksi 3 ===
        TransactionItem::create([
            'transaction_id' => $t3->id,
            'book_id' => 3,
            'quantity' => 1,
            'price' => 135000.00,
            'book_title' => 'The Shining',
            'author_name' => 'Stephen King',
        ]);
        TransactionItem::create([
            'transaction_id' => $t3->id,
            'book_id' => 5,
            'quantity' => 2,
            'price' => 110000.00,
            'book_title' => '1984',
            'author_name' => 'George Orwell',
        ]);
        TransactionItem::create([
            'transaction_id' => $t3->id,
            'book_id' => 1,
            'quantity' => 1,
            'price' => 120000.00,
            'book_title' => 'Murder on the Orient Express',
            'author_name' => 'Agatha Christie',
        ]);

        // === Transaksi 4 ===
        TransactionItem::create([
            'transaction_id' => $t4->id,
            'book_id' => 4,
            'quantity' => 2,
            'price' => 95000.00,
            'book_title' => 'Laskar Pelangi',
            'author_name' => 'Andrea Hirata',
        ]);
        TransactionItem::create([
            'transaction_id' => $t4->id,
            'book_id' => 5,
            'quantity' => 1,
            'price' => 110000.00,
            'book_title' => '1984',
            'author_name' => 'George Orwell',
        ]);
        TransactionItem::create([
            'transaction_id' => $t4->id,
            'book_id' => 2,
            'quantity' => 1,
            'price' => 150000.00,
            'book_title' => "Harry Potter and the Sorcerer's Stone",
            'author_name' => 'J.K. Rowling',
        ]);

        // === Transaksi 5 ===
        TransactionItem::create([
            'transaction_id' => $t5->id,
            'book_id' => 1,
            'quantity' => 2,
            'price' => 120000.00,
            'book_title' => 'Murder on the Orient Express',
            'author_name' => 'Agatha Christie',
        ]);
        TransactionItem::create([
            'transaction_id' => $t5->id,
            'book_id' => 3,
            'quantity' => 1,
            'price' => 135000.00,
            'book_title' => 'The Shining',
            'author_name' => 'Stephen King',
        ]);
        TransactionItem::create([
            'transaction_id' => $t5->id,
            'book_id' => 4,
            'quantity' => 1,
            'price' => 95000.00,
            'book_title' => 'Laskar Pelangi',
            'author_name' => 'Andrea Hirata',
        ]);
    }
}
