<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
class MovieController extends Controller
{
    public function movies(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $validatedData = $request->validate([
            'image' => "unique:movies,image,NULL,id,user_id,{$user->id}",
            'title' => "unique:movies,title,NULL,id,user_id,{$user->id}",
            'overview' => "unique:movies,overview,NULL,id,user_id,{$user->id}",
        ]);

        $validatedData['user_id'] = $user->id;
        $movie = Movie::create($validatedData);

        return response()->json($movie, 201);
    }
    public function getmovies() 
    {
        $user = JWTAuth::parseToken()->authenticate();
        $movies = Movie::where('user_id', $user->id)->get();

        return response()->json($movies);
    }
    public function deleteMovie($title)
{
    $user = JWTAuth::parseToken()->authenticate();
    $movie = Movie::where('title', $title)
                    ->where('user_id',$user->id)
                    ->first();
    
    if (!$movie) {
        return response()->json(['message' => 'Movie not found'], 404);
    }
    
    $movie->delete();

    return response()->json(['message' => 'Movie deleted successfully'], 200);
}
}
