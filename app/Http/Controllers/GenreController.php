<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();

        return $genres->isNotEmpty()
        ?
            response()->json([
                "status" => true,
                "message" => "Get All Resource",
                "data" => $genres
            ], 200)
        :
            response()->json([
                "status" => true,
                "message" => "Resource Data Not Found"
            ], 200)
        ;
    }

    public function store(Request $request)
    {
        # 1. validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'required|string'
        ]);

        # 2. check validator error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        # 3. insert data
        $genre = Genre::create([
            'name' => $request->name,
            'description' => $request->bio
        ]);

        # 5. response
        return response()->json([
            'status' => true,
            'message' => 'Resource Added Succesfully!',
            'data' => $genre
        ], 201);
    }

}
