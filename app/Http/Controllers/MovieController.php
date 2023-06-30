<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function movies(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'unique:movies',
            'title' => 'unique:movies',
            'overview' => 'unique:movies',
        ]);
        $movie = Movie::create($validatedData);

        return response()->json($movie, 201);
    }
    public function getmovies() 
    {
        $movies = Movie::all();

        return response()->json($movies);
    }
    public function deleteMovie($title)
{
    $movie = Movie::where('title', $title)->first();
    
    if (!$movie) {
        return response()->json(['message' => 'Movie not found'], 404);
    }
    
    $movie->delete();

    return response()->json(['message' => 'Movie deleted successfully'], 200);
}
}
