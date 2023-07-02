<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WantToWatchMovie;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
class WantToWatchMoviesController extends Controller
{
    public function wanttowatchmovies(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $validatedData = $request->validate([
            'wanttowatchimage' => "unique:want_to_watch_movies,wanttowatchimage,NULL,id,user_id,{$user->id}",
            'wanttowatchtitle' => "unique:want_to_watch_movies,wanttowatchtitle,NULL,id,user_id,{$user->id}",
            'wanttowatchoverview' => "unique:want_to_watch_movies,wanttowatchoverview,NULL,id,user_id,{$user->id}",
        ]);

        $validatedData['user_id'] = $user->id;
        $wanttowatchmovie = WantToWatchMovie::create($validatedData);

        return response()->json($wanttowatchmovie, 201);
    }
    public function getwanttowatchmovies()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $wanttowatchmovies = WantToWatchMovie::where('user_id', $user->id)->get();

        return response()->json($wanttowatchmovies);
    }
    public function deletewanttowatchmovies($title)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $wanttowatchmovies = WantToWatchMovie::where('wanttowatchtitle', $title)
                    ->where('user_id',$user->id)
                    ->first();

        if (!$wanttowatchmovies) {
            return response()->json(['message' => 'movie not found'], 404);
        }

        $wanttowatchmovies->delete();

        return response()->json(['message' => 'movie deleted successfully'], 200);
    }
}
