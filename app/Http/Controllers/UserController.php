<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return $users->isNotEmpty()
        ?
            response()->json([
                "success" => true,
                "message" => "Get All Resource",
                "data" => $users
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
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|min:8|max:255',
            'role' => 'required|string|in:admin,customer',
            'notelp' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        # 2. check validator error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        # 3. handle image upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image->store('users', 'public');
            $photoPath = $image->hashName();
        }

        # 4. insert data
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'notelp' => $request->notelp,
            'photo' => $photoPath,
        ]);

        # 5. response
        return response()->json([
            'status' => true,
            'message' => 'Resource Added Succesfully!',
            'data' => $user
        ], 201);
    }

    public function show(string $id)
    {
        $user = User::find($id);

        return $user
        ?
            response()->json([
                'status' => true,
                'message' => 'Get Detail Resource',
                'data' => $user
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
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Resource Not Found!'
            ], 404);
        }

        # 1.1. Cek autorisasi - hanya user dengan id 1 yang bisa mengedit user dengan id 1
        if ($id == 1 && (!Auth::check() || Auth::id() != 1)) { // Auth::id() != 1 berarti hanya user dengan ID 1 yang bisa mengedit user dengan ID 1
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized: Only user with ID 1 can edit this resource!'
            ], 403);
        }

        # 2. validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'username' => 'required|string|max:50|unique:users,username,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:admin,customer',
            'notelp' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        # 3. siapkan data yang ingin diupdate
        $data = $request->only(['name', 'email', 'username', 'role', 'notelp']);

        # 4. handle password jika diisi
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        # 5. handle image (upload & delete image lama)
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image->store('users', 'public');

            if ($user->photo) {
                Storage::disk('public')->delete('users/' . $user->photo);
            }

            $data['photo'] = $image->hashName();
        }

        # 6. update data baru ke database
        $user->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Resource Updated Successfully!',
            'data' => $user
        ], 200);
    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Resource Not Found!'
            ], 404);
        }

        if ($user->photo) {
            Storage::disk('public')->delete('users/' . $user->photo);
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete Resource Successfully'
        ]);
    }

}
