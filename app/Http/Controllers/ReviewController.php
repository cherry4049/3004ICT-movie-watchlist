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

    //show the existing review in an edit form
    public function edit(Review $review)
    {
        //only allow the review owener to edit it
        if ($review->user_id !== auth()->id()) {
            abort(403);
        }

        $review->load('movie');

        return view('reviews.edit', compact('review'));
    }

    //Receive the edit form submission and save the new information
    public function update(Request $request, Review $review)
    {
        //only allow the review owner to update it
        if ($review->user_id !== auth()->id()) {
            abort(403);
        }

        $validated =$request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $review->update([
            'rating' => $validated['rating'],
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()
            ->route('my-reviews')
            ->with('success', 'Your review has been updated successfully.');
    }

    //delete review
    public function destroy(Review $review)
    {
        // Only allow the review owner to delete it.
        if ($review->user_id !== auth()->id()) {
            abort(403);
        }

        $review->delete();

        return redirect()
            ->route('my-reviews')
            ->with('success', 'Your review has been deleted successfully.');
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