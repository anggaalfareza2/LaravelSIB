<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index() {
        $authors = Author::all();

        return response()->json([
            "succes" => true,
            "message" => "Get All Resources",
            "data" => $authors
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
}