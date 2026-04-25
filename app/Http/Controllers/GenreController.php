<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function index() {
        $genres = Genre::all();

        return response()->json([
            'succes'  => true,
            'message' => 'Get All Resources',
            'data'    => $genres
        ], 200);
    }

    public function store(Request $request) {
        // validator
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:100',
            'description' => 'required|string',
        ]);

        // check validator error
        if ($validator->fails()) {
            return response()->json([
                'succes'  => false,
                'message' => $validator->errors()
            ], 422);
        }

        // insert data
        $genre = Genre::create([
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        // response
        return response()->json([
            'succes'  => true,
            'message' => 'Resource added successfully',
            'data'    => $genre
        ], 201);
    }

    public function show(string $id) {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'succes'  => false,
                'message' => 'Resource not found'
            ], 404);
        }

        return response()->json([
            'succes'  => true,
            'message' => 'Get detail resource',
            'data'    => $genre
        ], 200);
    }

    public function update(string $id, Request $request) {
        // mencari data
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'succes'  => false,
                'message' => 'Resource not found'
            ], 404);
        }

        // validator
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:100',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'succes'  => false,
                'message' => $validator->errors()
            ], 422);
        }

        // update data
        $genre->update([
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return response()->json([
            'succes'  => true,
            'message' => 'Resource updated successfully',
            'data'    => $genre
        ], 200);
    }

    public function destroy(string $id) {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'succes'  => false,
                'message' => 'Resource not found'
            ], 404);
        }

        $genre->delete();

        return response()->json([
            'succes'  => true,
            'message' => 'Delete resource successfully'
        ], 200);
    }
}