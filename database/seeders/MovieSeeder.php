<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $inception = Movie::create([
            'title' => 'Inception',
            'description' => 'A skilled thief enters people’s dreams to steal and plant ideas.',
            'release_year' => 2010,
            'poster' => null,
        ]);

        $interstellar = Movie::create([
            'title' => 'Interstellar',
            'description' => 'A group of explorers travels through space to find a new home for humanity.',
            'release_year' => 2014,
            'poster' => null,
        ]);

        $darkKnight = Movie::create([
            'title' => 'The Dark Knight',
            'description' => 'Batman faces a dangerous criminal who creates chaos across Gotham City.',
            'release_year' => 2008,
            'poster' => null,
        ]);

        $inception->genres()->attach([
            Genre::where('name', 'Action')->first()->id,
            Genre::where('name', 'Science Fiction')->first()->id,
            Genre::where('name', 'Thriller')->first()->id,
        ]);

        $interstellar->genres()->attach([
            Genre::where('name', 'Adventure')->first()->id,
            Genre::where('name', 'Drama')->first()->id,
            Genre::where('name', 'Science Fiction')->first()->id,
        ]);

        $darkKnight->genres()->attach([
            Genre::where('name', 'Action')->first()->id,
            Genre::where('name', 'Drama')->first()->id,
            Genre::where('name', 'Thriller')->first()->id,
        ]);
    }
}