<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WatchingMovie;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
class WatchingMovieController extends Controller
{
    public function watchingmovies(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $validatedData = $request->validate([
            'watchingimage' => "unique:watching_movies,watchingimage,NULL,id,user_id,{$user->id}",
            'watchingtitle' => "unique:watching_movies,watchingtitle,NULL,id,user_id,{$user->id}",
            'watchingoverview' => "unique:watching_movies,watchingoverview,NULL,id,user_id,{$user->id}",
        ]);

        $validatedData['user_id'] = $user->id;
        $watchingmovie = WatchingMovie::create($validatedData);

        return response()->json($watchingmovie, 201);
    }

    public function getwatchingmovies()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $watchingmovies = WatchingMovie::where('user_id', $user->id)->get();

        return response()->json($watchingmovies);
    }

    public function deletewatchingmovies($title)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $watchingmovies = WatchingMovie::where('watchingtitle', $title)
                        ->where('user_id',$user->id)
                        ->first();

        if (!$watchingmovies) {
            return response()->json(['message' => 'movie not found'], 404);
        } 

        $watchingmovies->delete();

        return response()->json(['message' => 'movie deleted successfully'],200);
    }
}
