<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\WatchingMovieController;
use App\Http\Controllers\WantToWatchMoviesController;
use App\Http\Controllers\WantToWatchTvShowController;
use App\Http\Controllers\WatchedTvShowController;
use App\Http\Controllers\WatchingTvShowController;

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
    Route::delete('/movies/{title}', [MovieController::class, 'deleteMovie'] );
    Route::post('/watchingmovies', [WatchingMovieController::class, 'watchingmovies']);
    Route::get('/watchingmovies', [WatchingMovieController::class, 'getwatchingmovies']);
    Route::delete('/watchingmovies/{title}', [WatchingMovieController::class, 'deletewatchingmovies']);
    Route::post('/wanttowatchmovies', [WantToWatchMoviesController::class, 'wanttowatchmovies']);
    Route::get('/wanttowatchmovies', [WantToWatchMoviesController::class, 'getwanttowatchmovies']);
    Route::delete('wanttowatchmovies/{title}', [WantToWatchMoviesController::class, 'deletewanttowatchmovies']);
    Route::post('/watchedtvshows', [WatchedTvShowController::class , 'watchedtvshows']);
    Route::get('/watchedtvshows', [WatchedTvShowController::class , 'getwatchedtvshows']);
    Route::delete('watchedtvshows/{title}', [WatchedTvShowController::class, 'deletewatchedtvshows']);
    Route::post('/watchingtvshows', [WatchingTvShowController::class , 'watchingtvshows']);
    Route::get('/watchingtvshows', [WatchingTvShowController::class , 'getwatchingtvshows']);
    Route::delete('watchingtvshows/{title}', [WatchingTvShowController::class, 'deletewatchingtvshows']);
    Route::post('/wanttowatchtvshows', [WantToWatchTvShowController::class, 'wanttowatchtvshows']);
    Route::get('/wanttowatchtvshows', [WantToWatchTvShowController::class , 'getwanttowatchtvshows']);
    Route::delete('wanttowatchtvshows/{title}', [WantToWatchTvShowController::class, 'deletewanttowatchtvshows']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);