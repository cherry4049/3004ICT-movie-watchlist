<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MovieController::class, 'home'])
    ->name('home');

// Registration
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Public movie routes (guests are allowed to browse movies and read reviews)
Route::get('/movies', [MovieController::class, 'index'])
    ->name('movies.index');

Route::get('/movies/{movie}', [MovieController::class, 'show'])
    ->name('movies.show');

Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])
    ->name('reviews.edit');

Route::put('/reviews/{review}', [ReviewController::class, 'update'])
    ->name('reviews.update');

Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
    ->name('reviews.destroy');

// Admin movie management
Route::middleware(['auth', 'admin'])->group(function () {

    // Admin movie management
    Route::get('/admin/movies', [MovieController::class, 'adminIndex'])
            ->name('admin.movies.index');    
    
    // Admin movie create
    Route::get('/admin/movies/create', [MovieController::class, 'create'])
        ->name('admin.movies.create');

    // Save the new added movie
    Route::POST('/admin/movies', [MovieController::class, 'store'])
        ->name('admin.movies.store');

    // show movie edit form
    Route::get('/admin/movies/{movie}/edit', [MovieController::class, 'edit'])
        ->name('admin.movies.edit');

    // save movie edit form
    Route::put('/admin/movies/{movie}', [MovieController::class, 'update'])
        ->name('admin.movies.update');

    // Delete movie
    Route::delete('/admin/movies/{movie}', [MovieController::class, 'destroy'])
        ->name('admin.movies.destroy');
});

// Authenticated routes
Route::middleware('auth')->group(function () {

    Route::get('/my-reviews', [ReviewController::class, 'index'])
        ->name('my-reviews');

    Route::get('/movies/{movie}/reviews/create', [ReviewController::class, 'create'])
        ->name('reviews.create');

    Route::post('/movies/{movie}/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');    
     
});

