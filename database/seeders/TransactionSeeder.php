<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [3, 4, 5, 6, 7]; // ID customer dari 5 user pertama
        $statuses = ['paid', 'pending', 'cancelled'];
        $books = [
            1 => ['title' => 'Murder on the Orient Express', 'author' => 'Agatha Christie', 'price' => 120000],
            2 => ['title' => 'Harry Potter and the Sorcerer\'s Stone', 'author' => 'J.K. Rowling', 'price' => 150000],
            3 => ['title' => 'The Shining', 'author' => 'Stephen King', 'price' => 135000],
            4 => ['title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'price' => 95000],
            5 => ['title' => '1984', 'author' => 'George Orwell', 'price' => 110000],
            6 => ['title' => 'Hujan', 'author' => 'Tere Liye', 'price' => 85000],
            7 => ['title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer', 'price' => 125000],
            8 => ['title' => 'Supernova: Ksatria, Puteri, dan Bintang Jatuh', 'author' => 'Dee Lestari', 'price' => 98000],
            9 => ['title' => 'The Da Vinci Code', 'author' => 'Agatha Christie', 'price' => 140000],
            10 => ['title' => 'Harry Potter and the Chamber of Secrets', 'author' => 'J.K. Rowling', 'price' => 155000],
            11 => ['title' => 'It', 'author' => 'Stephen King', 'price' => 160000],
            12 => ['title' => 'Sang Pemimpi', 'author' => 'Andrea Hirata', 'price' => 90000],
            13 => ['title' => 'Animal Farm', 'author' => 'George Orwell', 'price' => 95000],
            14 => ['title' => 'Pulang', 'author' => 'Tere Liye', 'price' => 88000],
            15 => ['title' => 'Anak Semua Bangsa', 'author' => 'Pramoedya Ananta Toer', 'price' => 128000],
            16 => ['title' => 'Supernova: Akar', 'author' => 'Dee Lestari', 'price' => 102000],
            17 => ['title' => 'Angels & Demons', 'author' => 'Agatha Christie', 'price' => 138000],
            18 => ['title' => 'Harry Potter and the Prisoner of Azkaban', 'author' => 'J.K. Rowling', 'price' => 158000],
            19 => ['title' => 'Carrie', 'author' => 'Stephen King', 'price' => 125000],
            20 => ['title' => 'Edensor', 'author' => 'Andrea Hirata', 'price' => 92000],
        ];

        foreach ($customers as $customerId) {
            $numberOfTransactions = rand(1, 3);

            for ($t = 0; $t < $numberOfTransactions; $t++) {
                $numberOfItems = rand(1, 4);
                $totalAmount = 0;
                $usedBooks = [];

                $transaction = Transaction::create([
                    'user_id' => $customerId,
                    'transaction_code' => 'INV-' . strtoupper(uniqid()),
                    'total_amount' => 0, // Akan diupdate nanti
                    'status' => $statuses[array_rand($statuses)],
                ]);

                for ($i = 0; $i < $numberOfItems; $i++) {
                    $bookId = $this->getUniqueBookId($usedBooks, array_keys($books));
                    $usedBooks[] = $bookId;

                    $quantity = rand(1, 2);
                    $itemTotal = $books[$bookId]['price'] * $quantity;
                    $totalAmount += $itemTotal;

                    TransactionItem::create([
                        'transaction_id' => $transaction->id,
                        'book_id' => $bookId,
                        'quantity' => $quantity,
                        'price' => $books[$bookId]['price'],
                        'book_title' => $books[$bookId]['title'],
                        'author_name' => $books[$bookId]['author'],
                    ]);
                }

                // Update total amount
                $transaction->update(['total_amount' => $totalAmount]);
            }
        }
    }

    private function getUniqueBookId($usedBooks, $availableBooks)
    {
        do {
            $bookId = $availableBooks[array_rand($availableBooks)];
        } while (in_array($bookId, $usedBooks));

        return $bookId;
    }
}
