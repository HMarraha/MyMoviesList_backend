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

    public function deletewatchingmovies($title)
    {
        $watchingmovies = WatchingMovie::where('watchingtitle', $title)->first();

        if (!$watchingmovies) {
            return response()->json(['message' => 'movie not found'], 404);
        } 

        $watchingmovies->delete();

        return response()->json(['message' => 'movie deleted successfully'],200);
    }
}
