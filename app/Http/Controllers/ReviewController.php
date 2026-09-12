<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::where('user_id', auth()->id())
            ->with('movie')
            ->get();

        return view('my-reviews', compact('reviews'));
    }

    public function create(Movie $movie)
    {
        return view('reviews.create', compact('movie'));
    }

    public function store(Request $request, Movie $movie)
    {
        $validated = $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    if (Review::where('user_id', auth()->id())
        ->where('movie_id', $movie->id)
        ->exists()) {
        return back()
            ->withInput()
            ->withErrors([
                'review' => 'You have already reviewed this movie.',
            ]);
    }

        Review::create([
            'user_id' => auth()->id(),
            'movie_id' => $movie->id,
            'rating' => $validated['rating'],
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()
            ->route('my-reviews', $movie)
            ->with('success', 'Your review has been submitted successfully.');
    }
}