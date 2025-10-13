<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $data = new Genre();
        $genreData = $data->getGenres();

        return view('genres', ['genreList' => $genreData]);
    }
}
