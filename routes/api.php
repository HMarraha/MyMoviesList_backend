<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\WatchingMovieController;
use App\Http\Controllers\WantToWatchMoviesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/movies', [MovieController::class, 'movies']);
    Route::get('/movies', [MovieController::class, 'getmovies']);
    Route::post('/watchingmovies', [WatchingMovieController::class, 'watchingmovies']);
    Route::get('/watchingmovies', [WatchingMovieController::class, 'getwatchingmovies']);
    Route::post('/wanttowatchmovies', [WantToWatchMoviesController::class, 'wanttowatchmovies']);
    Route::get('/wanttowatchmovies', [WantToWatchMoviesController::class, 'getwanttowatchmovies']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);