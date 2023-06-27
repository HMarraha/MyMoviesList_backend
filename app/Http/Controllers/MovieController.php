<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function movies(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|unique:movies',
            'title' => 'required|unique:movies',
            'overview' => 'required|unique:movies',
        ]);
        $movie = Movie::create($validatedData);

        return response()->json($movie, 201);
    }
    public function getmovies() 
    {
        $movies = Movie::all();

        return response()->json($movies);
    }
}
