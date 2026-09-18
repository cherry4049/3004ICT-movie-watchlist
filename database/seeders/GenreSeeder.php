<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        Genre::create(['name' => 'Action']);
        Genre::create(['name' => 'Adventure']);
        Genre::create(['name' => 'Drama']);
        Genre::create(['name' => 'Science Fiction']);
        Genre::create(['name' => 'Thriller']);
        Genre::create(['name' => 'Other']);
    }
}