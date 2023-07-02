<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WatchingTvShow;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
class WatchingTvShowController extends Controller
{
    public function watchingtvshows(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $validatedData = $request->validate([
            'watchingtvshowimage' => "unique:watching_tv_shows,watchingtvshowimage,NULL,id,user_id,{$user->id}",
            'watchingtvshowtitle' => "unique:watching_tv_shows,watchingtvshowtitle,NULL,id,user_id,{$user->id}",
            'watchingtvshowoverview' => "unique:watching_tv_shows,watchingtvshowoverview,NULL,id,user_id,{$user->id}",
        ]);

        $validatedData['user_id'] = $user->id;
        $watchingtvshow = WatchingTvShow::create($validatedData);

        return response()->json($watchingtvshow, 201);
    }
    public function getwatchingtvshows()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $watchingtvshows = WatchingTvShow::where('user_id', $user->id)->get();

        return response()->json($watchingtvshows);
    }
    public function deletewatchingtvshows($title) 
    {
        $user = JWTAuth::parseToken()->authenticate();
        $watchingtvshows = WatchingTvShow::where('watchingtvshowtitle', $title)
                        ->where('user_id',$user->id)
                        ->first();

        if (!$watchingtvshows) {
            return response()->json(['message' => 'tvshow not found'], 404);
        }

        $watchingtvshows->delete();

        return response()->json(['message' => 'tvshow deleted successfully'], 200);
    }
}
