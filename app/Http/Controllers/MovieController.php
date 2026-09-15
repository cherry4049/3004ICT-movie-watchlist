<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // Home page lists newly added 9 movies
    public function home() {
        $movies = Movie::withAvg('reviews', 'rating')
            ->orderByDesc('created_at')
            ->take(9)
            ->get();

        return view('home', compact('movies'));
    }

    // browse-movies screen
    public function index(Request $request)
    {
        $search = $request->input('search');
        $genre = $request->input('genre');
        $year = $request->input('year');

        $query = Movie::with('genres')
            ->withAvg('reviews', 'rating');

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        if ($genre) {
            $query->whereHas('genres', function ($genreQuery) use ($genre) {
                $genreQuery->where('genres.id', $genre);
            });
        }

        if ($year) {
            $query->where('release_year', $year);
        }

        $movies = $query
            ->orderByDesc('release_year')
            ->paginate(16)

            // keeps the current search/filter values when moving between pages
            ->withQueryString();

        $genres = Genre::orderBy('name')->get();

        $years = Movie::select('release_year')
            ->distinct()
            ->orderByDesc('release_year')
            ->get();

        return view('movies.index', compact(
            'movies',
            'genres',
            'years',
            'search',
            'genre',
            'year'
        ));
    }

    // movie details screen
    public function show(Movie $movie)
    {
        $movie->load('reviews.user');

        return view('movies.show', compact('movie'));
    }

    // connect the Admin Movie Management page to the controller
    public function adminIndex(Request $request)
    {
        $search = $request->input('search');

        $query = Movie::with('genres');

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $movies = $query
            ->orderByDesc('created_at')
            ->get();

        return view('admin.movies.index', compact(
            'movies',
            'search'
        ));
    }

    // Get all available genres from the genres table
    // send them to Add Movie form as $genres
    public function create()
    {
        $genres = Genre::orderBy('name')->get();

        return view('admin.movies.create', compact('genres'));
    }

    // Make Add Movie form save a movie to the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_year' => 'required|integer|min:1888|max:' .date('Y'),
            'genres' => 'required|array|min:1',
            'genres.*' => 'exists:genres,id',
            'poster' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
        ], [
            'poster.uploaded' => 'The poster could not be uploaded. Please choose a JPEG, PNG, or GIF image no larger than 2 MB.',
            'poster.image' => 'The poster must be an image file.',
            'poster.mimes' => 'The poster must be a JPEG, PNG, or GIF image.',
            'poster.max' => 'The poster must be no larger than 2 MB.',
        ]);

        $posterName = null;

        if ($request->hasFile('poster')) {

            // Creates a filename using the current timestamp.
            $posterName = time() . '_' . $request->file('poster')->getClientOriginalName();

            // Moves the image into
            $request->file('poster')->move(
                public_path('images'),
                $posterName
            );
        }

        $movie = Movie::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'release_year' => $validated['release_year'],
            'poster' => $posterName,
        ]);

        // puts the selected movie_id + genre_id combinations into movie_genre
        $movie->genres()->attach($validated['genres']);
        
        return redirect()
            ->route('admin.movies.index')
            ->with('success', 'Movie has been added successfully.');
    }

    public function edit(Movie $movie)
    {
        // Load all genres
        $genres = Genre::orderBy('name')->get();

        // Load this movie's selected genres
        $movie->load('genres');

        // Send both to edit.blade.php
        return view('admin.movies.edit', compact(
            'movie',
            'genres'
        ));
    }

    // update movie
    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_year' => 'required|integer|min:1888|max:' . date('Y'),
            'genres' => 'required|array|min:1',
            'genres.*' => 'exists:genres,id',
            'poster' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
        ], [
            'poster.uploaded' => 'The poster could not be uploaded. Please choose a JPEG, PNG, or GIF image no larger than 2 MB.',
            'poster.image' => 'The poster must be an image file.',
            'poster.mimes' => 'The poster must be a JPEG, PNG, or GIF image.',
            'poster.max' => 'The poster must be no larger than 2 MB.',
        ]);
        
        // If the admin doesn't upload a new poster, the existing poster filename is kept.
        $posterName = $movie->poster;

        if ($request->hasFile('poster')) {
            $posterName = time() . '_' . $request->file('poster')->getClientOriginalName();

            $request->file('poster')->move(
                public_path('images'),
                $posterName
            );
        }

        $movie->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'release_year' => $validated['release_year'],
            'poster' => $posterName,
        ]);

        $movie->genres()->sync($validated['genres']);

        return redirect()
        ->route('admin.movies.index')
        ->with('success', 'Movie has been updated successfully.');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()
            ->route('admin.movies.index')
            ->with('success', 'Movie has been deleted successfully.');
    }
}