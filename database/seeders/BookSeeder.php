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

        Book::create([
            'title' => 'Hujan',
            'description' => 'Kisah persahabatan dan cinta di tengah bencana alam.',
            'price' => 85000.00,
            'stock' => 15,
            'cover_photo' => 'hujan.jpg',
            'genre_id' => 6,
            'author_id' => 6
        ]);

        Book::create([
            'title' => 'Bumi Manusia',
            'description' => 'Novel sejarah tentang perjuangan pribumi di masa kolonial.',
            'price' => 125000.00,
            'stock' => 20,
            'cover_photo' => 'bumi_manusia.jpg',
            'genre_id' => 9,
            'author_id' => 7
        ]);

        Book::create([
            'title' => 'Supernova: Ksatria, Puteri, dan Bintang Jatuh',
            'description' => 'Kisah filosofis tentang pencarian jati diri dan cinta.',
            'price' => 98000.00,
            'stock' => 18,
            'cover_photo' => 'supernova1.jpeg',
            'genre_id' => 7,
            'author_id' => 8
        ]);

        Book::create([
            'title' => 'The Da Vinci Code',
            'description' => 'Petualangan memecahkan kode rahasia dalam karya seni Leonardo da Vinci.',
            'price' => 140000.00,
            'stock' => 22,
            'cover_photo' => 'davinci_code.jpg',
            'genre_id' => 8,
            'author_id' => 1
        ]);

        Book::create([
            'title' => 'Harry Potter and the Chamber of Secrets',
            'description' => 'Petualangan kedua Harry Potter menghadapi misteri Kamar Rahasia.',
            'price' => 155000.00,
            'stock' => 20,
            'cover_photo' => 'hp2.jpg',
            'genre_id' => 2,
            'author_id' => 2
        ]);

        Book::create([
            'title' => 'It',
            'description' => 'Kisah horor tentang badai pembunuh yang menyamar sebagai badut.',
            'price' => 160000.00,
            'stock' => 14,
            'cover_photo' => 'it.jpg',
            'genre_id' => 3,
            'author_id' => 3
        ]);

        Book::create([
            'title' => 'Sang Pemimpi',
            'description' => 'Kelanjutan kisah Laskar Pelangi tentang perjuangan meraih mimpi.',
            'price' => 90000.00,
            'stock' => 25,
            'cover_photo' => 'sang_pemimpi.jpg',
            'genre_id' => 4,
            'author_id' => 4
        ]);

        Book::create([
            'title' => 'Animal Farm',
            'description' => 'Allegori politik tentang revolusi dan kekuasaan.',
            'price' => 95000.00,
            'stock' => 16,
            'cover_photo' => 'animal_farm.jpg',
            'genre_id' => 5,
            'author_id' => 5
        ]);

        Book::create([
            'title' => 'Pulang',
            'description' => 'Kisah perjalanan panjang seorang pria mencari jati diri.',
            'price' => 88000.00,
            'stock' => 19,
            'cover_photo' => 'pulang.jpg',
            'genre_id' => 6,
            'author_id' => 6
        ]);

        Book::create([
            'title' => 'Anak Semua Bangsa',
            'description' => 'Bagian kedua dari Tetralogi Buru yang mengisahkan perjuangan Minke.',
            'price' => 128000.00,
            'stock' => 17,
            'cover_photo' => 'anak_semua_bangsa.jpg',
            'genre_id' => 9,
            'author_id' => 7
        ]);

        Book::create([
            'title' => 'Supernova: Akar',
            'description' => 'Bagian kedua serial Supernova yang penuh dengan misteri dan filosofi.',
            'price' => 102000.00,
            'stock' => 21,
            'cover_photo' => 'supernova2.jpg',
            'genre_id' => 7,
            'author_id' => 8
        ]);

        Book::create([
            'title' => 'Angels & Demons',
            'description' => 'Petualangan Robert Langdon mengungkap konspirasi Illuminati.',
            'price' => 138000.00,
            'stock' => 23,
            'cover_photo' => 'angels_demons.jpg',
            'genre_id' => 8,
            'author_id' => 1
        ]);

        Book::create([
            'title' => 'Harry Potter and the Prisoner of Azkaban',
            'description' => 'Petualangan ketiga Harry Potter dengan ancaman dari Azkaban.',
            'price' => 158000.00,
            'stock' => 18,
            'cover_photo' => 'hp3.jpg',
            'genre_id' => 2,
            'author_id' => 2
        ]);

        Book::create([
            'title' => 'Carrie',
            'description' => 'Kisah horor tentang seorang gadis dengan kemampuan telekinesis.',
            'price' => 125000.00,
            'stock' => 12,
            'cover_photo' => 'carrie.jpg',
            'genre_id' => 3,
            'author_id' => 3
        ]);

        Book::create([
            'title' => 'Edensor',
            'description' => 'Petualangan Ikal dan Arai menjelajahi Eropa mencari arti kehidupan.',
            'price' => 92000.00,
            'stock' => 26,
            'cover_photo' => 'edensor.jpg',
            'genre_id' => 4,
            'author_id' => 4
        ]);
    }
}
