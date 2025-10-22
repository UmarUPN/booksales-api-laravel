<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();

        return $authors->isNotEmpty()
        ?
            response()->json([
                "success" => true,
                "message" => "Get All Resource",
                "data" => $authors
            ], 200)
        :
            response()->json([
                "success" => true,
                "message" => "Resource Data Not Found"
            ], 200)
        ;
    }

    public function store(Request $request)
    {
        # 1. validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'photo' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'bio' => 'required|string'
        ]);

        # 2. check validator error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        # 3. upload image
        $image = $request->file('photo');
        $image->store('authors', 'public');

        # 4. insert data
        $author = Author::create([
            'name' => $request->name,
            'photo' => $image->hashName(),
            'bio' => $request->bio
        ]);

        # 5. response
        return response()->json([
            'status' => true,
            'message' => 'Resource Added Succesfully!',
            'data' => $author
        ], 201);
    }

    public function show(string $id)
    {
        $author = Author::find($id);

        return $author
        ?
            response()->json([
                'status' => true,
                'message' => 'Get Detail Resource',
                'data' => $author
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
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'status' => false,
                'message' => 'Resource Not Found!'
            ], 404);
        }

        # 2. validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'bio' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }

        # 3. siapkan data yang ingin diupdate
        $data = $request->only(['name', 'bio']);

        # 4. handle image (upload $ delete image lama)
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image ->store('authors', 'public');

            if ($author->photo) {
                Storage::disk('public')->delete('authors/' . $author->photo);
            }

            $data['photo'] = $image->hashName();
        }

        # 5. update data baru ke database
        $author->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Resource Updated Successfully!',
            'data' => $author
        ], 200);
    }

    public function destroy(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'status' => false,
                'message' => 'Resource Not Found!'
            ], 404);
        }

        if ($author->photo) {
            Storage::disk('public')->delete('authors/' . $author->photo);
        }

        $author->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete Resource Successfully'
        ]);
    }

}
