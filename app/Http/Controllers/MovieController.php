<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required',
            'title' => 'required',
            'genre' => 'required',
            'year' => 'required|integer',
            'duration' => 'required|integer',
        ]);

        $movie = Movie::create($validatedData);

        return response()->json($movie, 201);
    }
}
