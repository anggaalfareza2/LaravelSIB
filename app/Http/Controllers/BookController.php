<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class BookController extends Controller
{
    public function index() {
        $books = Book::all();

        return response()->json([
            "succes" => true,
            "message" => "Get All Resources",
            "data" => $books
        ], 200);
    }

    public function store(Request $request) {
        // validator
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:100',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'stok'        =>  'required|integer',
            'cover_photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'genre_id'    => 'required|exists:genres,id',
            'author_id'   => 'required|exists:authors,id'
        ]);

        // check validator error
        if ($validator->fails()) {
            return response()->json([
                'succes'  => false,
                'message' => $validator->errors()
            ], 422);
        }

        // upload image
        $image = $request->file('cover_photo');
        $image->store('books', 'public');

        // insert data
        $book = Book::create([
            'title'       => $request->title,
            'description' => $request->description,
            'price'       => $request->price,
            'stok'        => $request->stok,
            'cover_photo' => $image->hashName(),
            'genre_id'    => $request->genre_id,
            'author_id'   => $request->author_id,
        ]);

        // response
        return response()->json([
            'succes'  => true,
            'message' => 'Resource added successfully',
            'data'    => $book
        ], 201);
    }
      
    public function show(string $id) {
            $book = Book::find($id);

            if (!$book) {
                return response()->json([
                    'succes' => false,
                    'message' => 'Resource not found'
                ], 404);
            }

            return response()->json([
                'succes' => true,
                'message' =>'Get detail resource',
                'data' => $book
            ], 200);
        }
    public function update(string $id, Request $request) {
        //mencari data
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'succes' => false,
                'message' => 'Resource not found'
            ], 404);
        }
        //validator
         $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:100',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'stok'        => 'required|integer',
            'cover_photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'genre_id'    => 'required|exists:genres,id',
            'author_id'   => 'required|exists:authors,id'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'succes'  => false,
                'message' => $validator->errors()
            ], 422);
        }

        //siapkan data yang ingin di update
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stok' => $request->stok,
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id,
        ];

         //update data baru ke database
        $book->update($data);
        
        return response()->json([
                'succes' => true,
                'message' =>'Resource updated succesfully',
                'data' => $book
            ], 200);

        //handle image (upload & delete image)
        if ($request->hasFile('cover_photo')) {
            $image = $request->file('cover_photo');
            $image->store('books', 'public');

            if ($book->cover_photo) {
            Storage::disk('public')->delete('books/' . $book->cover_photo);
         }

            $data['cover_photo'] = $image->hashName();
        }

       
    }

    public function destroy(string $id) {
        $book = Book::find($id);

         if (!$book) {
                return response()->json([
                    'succes' => false,
                    'message' => 'Resource not found'
                ], 404);
            }

        if ($book->cover_photo) {
            Storage::disk('public')->delete('books/' . $book->cover_photo);
        }

        $book->delete();

        return response()->json([
            'succes' => true,
            'message' => 'Delete resource sucessfully'
        ]);
    }
}