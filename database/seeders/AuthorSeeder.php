<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'J.K. Rowling',
            'photo' => 'jk_rowling.jpg',
            'bio' => 'British author, best known for the Harry Potter series.'
        ]);

        Author::create([
            'name' => 'George R.R. Martin',
            'photo' => 'george_rr_martin.jpg',
            'bio' => 'American novelist best known for A Song of Ice and Fire.'
        ]);

        Author::create([
            'name' => 'Isaac Asimov',
            'photo' => 'isaac_asimov.jpg',
            'bio' => 'American author known for science fiction and popular science.'
        ]);

        Author::create([
            'name' => 'Agatha Christie',
            'photo' => 'agatha_christie.jpg',
            'bio' => 'English writer known for her detective novels.'
        ]);

        Author::create([
            'name' => 'Stephen King',
            'photo' => 'stephen_king.jpg',
            'bio' => 'American author of horror, supernatural fiction, and fantasy.'
        ]);
    }
}
