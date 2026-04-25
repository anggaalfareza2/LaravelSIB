<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index() {
        $authors = Author::all();

        return response()->json([
            'succes'  => true,
            'message' => 'Get All Resources',
            'data'    => $authors
        ], 200);
    }

    public function store(Request $request) {
        // validator
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:100',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'bio'   => 'required|string',
        ]);

        // check validator error
        if ($validator->fails()) {
            return response()->json([
                'succes'  => false,
                'message' => $validator->errors()
            ], 422);
        }

        // upload image
        $image = $request->file('photo');
        $image->store('authors', 'public');

        // insert data
        $author = Author::create([
            'name'  => $request->name,
            'photo' => $image->hashName(),
            'bio'   => $request->bio,
        ]);

        // response
        return response()->json([
            'succes'  => true,
            'message' => 'Resource added successfully',
            'data'    => $author
        ], 201);
    }

    public function show(string $id) {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'succes'  => false,
                'message' => 'Resource not found'
            ], 404);
        }

        return response()->json([
            'succes'  => true,
            'message' => 'Get detail resource',
            'data'    => $author
        ], 200);
    }

    public function update(string $id, Request $request) {
        // mencari data
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'succes'  => false,
                'message' => 'Resource not found'
            ], 404);
        }

        // validator
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'bio'   => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'succes'  => false,
                'message' => $validator->errors()
            ], 422);
        }

        // siapkan data yang ingin di update
        $data = [
            'name' => $request->name,
            'bio'  => $request->bio,
        ];

        // handle image (upload & delete image)
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');

            // hapus foto lama dulu
            if ($author->photo) {
                Storage::disk('public')->delete('authors/' . $author->photo);
            }

            // simpan foto baru
            $image->store('authors', 'public');
            $data['photo'] = $image->hashName();
        }

        // update data
        $author->update($data);

        return response()->json([
            'succes'  => true,
            'message' => 'Resource updated successfully',
            'data'    => $author
        ], 200);
    }

    public function destroy(string $id) {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'succes'  => false,
                'message' => 'Resource not found'
            ], 404);
        }

        if ($author->photo) {
            Storage::disk('public')->delete('authors/' . $author->photo);
        }

        $author->delete();

        return response()->json([
            'succes'  => true,
            'message' => 'Delete resource successfully'
        ], 200);
    }
}