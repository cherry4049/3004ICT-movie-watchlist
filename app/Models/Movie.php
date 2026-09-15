<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    //allow Movie::create() or $movie->update() to fill
    protected $fillable = [
        'title',
        'description',
        'release_year',
        'poster',
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'movie_genre');
    }
}