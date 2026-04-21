<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Harry Potter and the Sorcerers Stone',
            'description' => 'Kisah seorang anak yang mengetahui dirinya adalah penyihir.',
            'price' => 95000,
            'stok' => 20,
            'cover_photo' => 'harry_potter.jpg',
            'genre_id' => 3,
            'author_id' => 1
        ]);

        Book::create([
            'title' => 'A Game of Thrones',
            'description' => 'Perebutan kekuasaan di dunia fantasi penuh intrik.',
            'price' => 120000,
            'stok' => 15,
            'cover_photo' => 'got.jpg',
            'genre_id' => 3,
            'author_id' => 2
        ]);

        Book::create([
            'title' => 'Foundation',
            'description' => 'Kisah jatuhnya peradaban galaksi dan usaha menyelamatkannya.',
            'price' => 85000,
            'stok' => 10,
            'cover_photo' => 'foundation.jpg',
            'genre_id' => 1,
            'author_id' => 3
        ]);

        Book::create([
            'title' => 'Murder on the Orient Express',
            'description' => 'Detektif Hercule Poirot memecahkan kasus pembunuhan di kereta.',
            'price' => 75000,
            'stok' => 12,
            'cover_photo' => 'orient_express.jpg',
            'genre_id' => 2,
            'author_id' => 4
        ]);

        Book::create([
            'title' => 'The Shining',
            'description' => 'Seorang penulis perlahan kehilangan kewarasannya di hotel terpencil.',
            'price' => 90000,
            'stok' => 8,
            'cover_photo' => 'the_shining.jpg',
            'genre_id' => 1,
            'author_id' => 5
        ]);
    }
}
