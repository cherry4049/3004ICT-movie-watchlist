<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TmdbService
{
    public function searchMovies(string $query)
    {
        return Http::withToken(config('services.tmdb.token'))
            ->withOptions([
                'verify'=> 'C:\php\extras\ssl\cacert.pem',
            ])
            ->get('https://api.themoviedb.org/3/search/movie', [
                'query' => $query,
                'include_adult' => false,
                'language' => 'en-US'
            ])
            ->json();
    }

    public function downloadPoster(string $posterPath, string $filename)
    {
        $response = Http::withOptions([
            'verify' => 'C:\php\extras\ssl\cacert.pem',
        ])->get(
            'https://image.tmdb.org/t/p/w500' . $posterPath
        );

        if ($response->successful()) {
           
            file_put_contents(
                public_path('images/' . $filename),
                $response->body()
            );

            return $filename;
        }

        return null;
    }
}