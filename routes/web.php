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

    
// Authenticated routes
Route::middleware('auth')->group(function () {

    Route::get('/my-reviews', [ReviewController::class, 'index'])
        ->name('my-reviews');

    Route::get('/movies/{movie}/reviews/create', [ReviewController::class, 'create'])
        ->name('reviews.create');

    Route::post('/movies/{movie}/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');
    
     
});

