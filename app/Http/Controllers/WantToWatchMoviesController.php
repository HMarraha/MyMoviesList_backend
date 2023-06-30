<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WantToWatchMovie;

class WantToWatchMoviesController extends Controller
{
    public function wanttowatchmovies(Request $request)
    {
        $validatedData = $request->validate([
            'wanttowatchimage' => 'unique:want_to_watch_movies',
            'wanttowatchtitle' => 'unique:want_to_watch_movies',
            'wanttowatchoverview' => 'unique:want_to_watch_movies',
        ]);
        $wanttowatchmovie = WantToWatchMovie::create($validatedData);

        return response()->json($wanttowatchmovie, 201);
    }
    public function getwanttowatchmovies()
    {
        $wanttowatchmovies = WantToWatchMovie::all();

        return response()->json($wanttowatchmovies);
    }
    public function deletewanttowatchmovies($title)
    {
        $wanttowatchmovies = WantToWatchMovie::where('wanttowatchtitle', $title)->first();

        if (!$wanttowatchmovies) {
            return response()->json(['message' => 'movie not found'], 404);
        }

        $wanttowatchmovies->delete();

        return response()->json(['message' => 'movie deleted successfully'], 200);
    }
}
