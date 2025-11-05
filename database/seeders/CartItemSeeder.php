<?php

namespace Database\Seeders;

use App\Models\CartItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [3, 4, 5, 6, 7];

        foreach ($customers as $customerId) {
            $numberOfItems = rand(1, 3);
            $usedBooks = [];

            for ($i = 0; $i < $numberOfItems; $i++) {
                $bookId = $this->getUniqueBookId($usedBooks);
                $usedBooks[] = $bookId;

                CartItem::create([
                    'user_id' => $customerId,
                    'book_id' => $bookId,
                    'quantity' => rand(1, 3),
                ]);
            }
        }
    }

    private function getUniqueBookId($usedBooks)
    {
        do {
            $bookId = rand(1, 20);
        } while (in_array($bookId, $usedBooks));

        return $bookId;
    }
}
