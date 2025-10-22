<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Book::create([
            'title' => 'Murder on the Orient Express',
            'description' => 'Kasus pembunuhan di kereta mewah yang diselidiki oleh Hercule Poirot.',
            'price' => 120000.00,
            'stock' => 10,
            'cover_photo' => 'orient_express.jpg',
            'genre_id' => 1,
            'author_id' => 1
        ]);

        Book::create([
            'title' => 'Harry Potter and the Sorcerer\'s Stone',
            'description' => 'Petualangan pertama Harry Potter di Hogwarts.',
            'price' => 150000.00,
            'stock' => 25,
            'cover_photo' => 'hp1.jpg',
            'genre_id' => 2,
            'author_id' => 2
        ]);

        Book::create([
            'title' => 'The Shining',
            'description' => 'Kisah menyeramkan tentang hotel berhantu dan seorang anak dengan kekuatan khusus.',
            'price' => 135000.00,
            'stock' => 8,
            'cover_photo' => 'shining.jpg',
            'genre_id' => 3,
            'author_id' => 3
        ]);

        Book::create([
            'title' => 'Laskar Pelangi',
            'description' => 'Kisah inspiratif anak-anak dari Belitung yang berjuang untuk pendidikan.',
            'price' => 95000.00,
            'stock' => 30,
            'cover_photo' => 'laskar.jpg',
            'genre_id' => 4,
            'author_id' => 4
        ]);

        Book::create([
            'title' => '1984',
            'description' => 'Novel distopia tentang pengawasan total dan hilangnya kebebasan.',
            'price' => 110000.00,
            'stock' => 12,
            'cover_photo' => '1984.jpg',
            'genre_id' => 5,
            'author_id' => 5
        ]);
    }

}
