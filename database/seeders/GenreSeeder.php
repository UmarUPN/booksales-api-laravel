<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Genre::create([
            'name' => 'Mystery',
            'description' => 'Genre yang berfokus pada pemecahan teka-teki atau kejahatan.'
        ]);

        Genre::create([
            'name' => 'Fantasy',
            'description' => 'Cerita yang melibatkan dunia magis dan makhluk supernatural.'
        ]);

        Genre::create([
            'name' => 'Horror',
            'description' => 'Genre yang bertujuan menakut-nakuti dan menggugah rasa takut.'
        ]);

        Genre::create([
            'name' => 'Drama',
            'description' => 'Cerita yang menggambarkan konflik emosional dan kehidupan nyata.'
        ]);

        Genre::create([
            'name' => 'Dystopian',
            'description' => 'Genre yang menggambarkan masyarakat masa depan yang suram.'
        ]);

    }
}
