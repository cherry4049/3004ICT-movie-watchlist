<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        $inception = Movie::where('title', 'Inception')->first();
        $interstellar = Movie::where('title', 'Interstellar')->first();

        Review::create([
            'user_id' => $user->id,
            'movie_id' => $inception->id,
            'rating' => 5,
            'title' => 'Amazing Movie',
            'content' => 'Inception is a great science fiction movie with an interesting story.',
        ]);

        Review::create([
            'user_id' => $user->id,
            'movie_id' => $interstellar->id,
            'rating' => 4,
            'title' => 'Very Enjoyable',
            'content' => 'Interstellar has an engaging story and impressive visuals.',
        ]);
    }
}