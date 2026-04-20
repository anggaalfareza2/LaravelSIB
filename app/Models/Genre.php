<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    private $genres = [
        [
            'id' => 1,
            'name' => 'Fiction',
            'description' => 'A literary work based on the imagination and not necessarily on fact.'
        ],
        [
            'id' => 2,
            'name' => 'Non-Fiction',
            'description' => 'A literary work based on facts and real events.'
        ],
        [
            'id' => 3,
            'name' => 'Science Fiction',
            'description' => 'A genre that deals with imaginative and futuristic concepts.'
        ],
        [
            'id' => 4,
            'name' => 'Mystery',
            'description' => 'A genre that focuses on the solution of a crime or a puzzle.'
        ],
        [
            'id' => 5,
            'name' => 'Romance',
            'description' => 'A genre that focuses on love and romantic relationships.'
        ],
    ];

    public function getGenres()
    {
        return $this->genres;
    }
}
