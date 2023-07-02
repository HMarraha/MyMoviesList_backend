<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WatchedTvShow;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
class WatchedTvShowController extends Controller
{
    public function watchedtvshows(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $validatedData = $request->validate([
            'watchedtvshowimage' => "unique:watched_tv_shows,watchedtvshowimage,NULL,id,user_id,{$user->id}",
            'watchedtvshowtitle' => "unique:watched_tv_shows,watchedtvshowtitle,NULL,id,user_id,{$user->id}",
            'watchedtvshowoverview' => "unique:watched_tv_shows,watchedtvshowoverview,NULL,id,user_id,{$user->id}",
        ]);

        $validatedData['user_id'] = $user->id;
        $watchedtvshow = WatchedTvShow::create($validatedData);

        return response()->json($watchedtvshow, 201);
    }

    public function getwatchedtvshows()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $watchedtvshows = WatchedTvShow::where('user_id', $user->id)->get();

        return response()->json($watchedtvshows);
    }
    public function deletewatchedtvshows($title)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $watchedtvshows = WatchedTvShow::where('watchedtvshowtitle', $title)
                        ->where('user_id',$user->id)
                        ->first();
        
        if(!$watchedtvshows) {
            return response()->json(['message' => 'tvshow not found'], 404);
        }

        $watchedtvshows->delete();

        return response()->json(['message' => 'tvshow deleted successfully'], 200);
    }
}
