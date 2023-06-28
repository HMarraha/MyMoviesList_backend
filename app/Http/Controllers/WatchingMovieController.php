<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WatchingMovie;

class WatchingMovieController extends Controller
{
    public function watchingmovies(Request $request)
    {
        $validatedData = $request->validate([
            'watchingimage' => 'unique:watching_movies',
            'watchingtitle' => 'unique:watching_movies',
            'watchingoverview' => 'unique:watching_movies'
        ]);
        $watchingmovie = WatchingMovie::create($validatedData);

        return response()->json($watchingmovie, 201);
    }

    public function getwatchingmovies()
    {
        $watchingmovies = WatchingMovie::all();

        return response()->json($watchingmovies);
    }
}
