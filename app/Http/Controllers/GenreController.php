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
            'description' => $request->description
        ]);

        # 5. response
        return response()->json([
            'status' => true,
            'message' => 'Resource Added Succesfully!',
            'data' => $genre
        ], 201);
    }

    public function show(string $id)
    {
        $genre = Genre::find($id);

        return $genre
        ?
            response()->json([
                'status' => true,
                'message' => 'Get Detail Resource',
                'data' => $genre
            ], 200)
        :
            response()->json([
                'status' => false,
                'message' => 'Resource Not Found!'
            ], 404)
        ;
    }

    public function update(string $id, Request $request)
    {
        # 1. mencari data
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'status' => false,
                'message' => 'Resource Not Found!'
            ], 404);
        }

        # 2. validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 404);
        }

        # 3. siapkan data yang ingin diupdate
        $data = [
            'name' => 'required|string|max:100',
            'description' => 'required|string'
        ];

        # 4. update data baru ke database
        $genre->update($data);

        return response()->json([
                'status' => true,
                'message' => 'Resource Updated Successfully!',
                'data' => $genre
            ], 200);
    }

    public function destroy(string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'status' => false,
                'message' => 'Resource Not Found!'
            ], 404);
        }

        $genre->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete Resource Successfully'
        ]);
    }

}
