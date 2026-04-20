<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    private $authors = [
        [
            'id' => 1,
            'name' => 'J.K. Rowling',
            'photo' => 'jk_rowling.jpg',
            'bio' => 'British author, best known for the Harry Potter series.'
        ],
        [
            'id' => 2,
            'name' => 'George R.R. Martin',
            'photo' => 'george_rr_martin.jpg',
            'bio' => 'American novelist best known for A Song of Ice and Fire.'
        ],
        [
            'id' => 3,
            'name' => 'Isaac Asimov',
            'photo' => 'isaac_asimov.jpg',
            'bio' => 'American author known for science fiction and popular science.'
        ],
        [
            'id' => 4,
            'name' => 'Agatha Christie',
            'photo' => 'agatha_christie.jpg',
            'bio' => 'English writer known for her detective novels.'
        ],
        [
            'id' => 5,
            'name' => 'Stephen King',
            'photo' => 'stephen_king.jpg',
            'bio' => 'American author of horror, supernatural fiction, and fantasy.'
        ],
    ];

    public function getAuthors()
    {
        return $this->authors;
    }
}
