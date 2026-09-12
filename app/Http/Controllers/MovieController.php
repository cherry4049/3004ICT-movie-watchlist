<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function home()
    {
        $movies = Movie::withAvg('reviews', 'rating')
            ->orderByDesc('release_year')
            ->take(4)
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

        $filtersUsed = $search || $genre || $year;

        $matchingMovies = collect();

        if ($filtersUsed) {

            // Get matching movies first.
            $matchingMovies = $query
                ->orderByDesc('release_year')
                ->get();

            // Get 3 recent movies that are not already in the results.
            $recentMovies = Movie::with('genres')
                ->withAvg('reviews', 'rating')
                ->whereNotIn('id', $matchingMovies->pluck('id'))
                ->orderByDesc('release_year')
                ->take(3)
                ->get();

            // Matching movies appear first, followed by recent movies.
            $movies = $matchingMovies->concat($recentMovies);

        } else {

            // Default: show 4 most recent movies.
            $movies = Movie::with('genres')
                ->withAvg('reviews', 'rating')
                ->orderByDesc('release_year')
                ->take(4)
                ->get();
        }

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
            'year',
            'filtersUsed',
            'matchingMovies'
        ));
    }

    public function show(Movie $movie)
    {
        $movie->load('reviews.user');

        return view('movies.show', compact('movie'));
    }
}