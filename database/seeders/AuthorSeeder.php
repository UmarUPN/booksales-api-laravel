<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Author::create([
            'name' => 'Agatha Christie',
            'photo' => 'agatha.jpg',
            'bio' => 'Penulis misteri terkenal dengan karakter Hercule Poirot dan Miss Marple.'
        ]);

        Author::create([
            'name' => 'J.K. Rowling',
            'photo' => 'rowling.jpg',
            'bio' => 'Penulis seri Harry Potter yang mendunia.'
        ]);

        Author::create([
            'name' => 'Stephen King',
            'photo' => 'king.jpg',
            'bio' => 'Raja horor modern dengan karya seperti IT dan The Shining.'
        ]);

        Author::create([
            'name' => 'Andrea Hirata',
            'photo' => 'andrea.jpg',
            'bio' => 'Penulis Indonesia terkenal dengan novel Laskar Pelangi.'
        ]);

        Author::create([
            'name' => 'George Orwell',
            'photo' => 'orwell.jpg',
            'bio' => 'Penulis novel distopia seperti 1984 dan Animal Farm.'
        ]);

        Author::create([
            'name' => 'Tere Liye',
            'photo' => 'tereliye.jpg',
            'bio' => 'Penulis Indonesia produktif dengan berbagai genre fiksi.'
        ]);

        Author::create([
            'name' => 'Pramoedya Ananta Toer',
            'photo' => 'pramoedya.jpg',
            'bio' => 'Sastrawan Indonesia terkenal dengan Tetralogi Buru.'
        ]);

        Author::create([
            'name' => 'Dee Lestari',
            'photo' => 'dee.jpg',
            'bio' => 'Penulis dan musisi Indonesia dengan karya kontemporer.'
        ]);

    }
}
