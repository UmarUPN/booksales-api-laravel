<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    private $authors = [
        [
            'id' => 1,
            'name' => 'Agatha Christie',
            'photo' => 'agatha.jpg',
            'bio' => 'Penulis misteri terkenal dengan karakter Hercule Poirot dan Miss Marple.'
        ],
        [
            'id' => 2,
            'name' => 'J.K. Rowling',
            'photo' => 'rowling.jpg',
            'bio' => 'Penulis seri Harry Potter yang mendunia.'
        ],
        [
            'id' => 3,
            'name' => 'Stephen King',
            'photo' => 'king.jpg',
            'bio' => 'Raja horor modern dengan karya seperti IT dan The Shining.'
        ],
        [
            'id' => 4,
            'name' => 'Andrea Hirata',
            'photo' => 'andrea.jpg',
            'bio' => 'Penulis Indonesia terkenal dengan novel Laskar Pelangi.'
        ],
        [
            'id' => 5,
            'name' => 'George Orwell',
            'photo' => 'orwell.jpg',
            'bio' => 'Penulis novel distopia seperti 1984 dan Animal Farm.'
        ]
    ];

    public function getAuthors()
    {
        return $this->authors;
    }

}
