<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    private $genres = [
        [
            'id' => 1,
            'name' => 'Mystery',
            'description' => 'Genre yang berfokus pada pemecahan teka-teki atau kejahatan.'
        ],
        [
            'id' => 2,
            'name' => 'Fantasy',
            'description' => 'Cerita yang melibatkan dunia magis dan makhluk supernatural.'
        ],
        [
            'id' => 3,
            'name' => 'Horror',
            'description' => 'Genre yang bertujuan menakut-nakuti dan menggugah rasa takut.'
        ],
        [
            'id' => 4,
            'name' => 'Drama',
            'description' => 'Cerita yang menggambarkan konflik emosional dan kehidupan nyata.'
        ],
        [
            'id' => 5,
            'name' => 'Dystopian',
            'description' => 'Genre yang menggambarkan masyarakat masa depan yang suram.'
        ]
    ];

    public function getGenres()
    {
        return $this->genres;
    }

}
