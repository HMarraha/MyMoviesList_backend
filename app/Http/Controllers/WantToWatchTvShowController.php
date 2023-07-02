<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WantToWatchTvShow;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
class WantToWatchTvShowController extends Controller
{
    public function wanttowatchtvshows(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $validatedData = $request->validate([
            'wanttowatchtvshowimage' => "unique:want_to_watch_tv_shows,wanttowatchtvshowimage,NULL,id,user_id,{$user->id}",
            'wanttowatchtvshowtitle' => "unique:want_to_watch_tv_shows,wanttowatchtvshowtitle,NULL,id,user_id,{$user->id}",
            'wanttowatchtvshowoverview' => "unique:want_to_watch_tv_shows,wanttowatchtvshowoverview,NULL,id,user_id,{$user->id}",
        ]);

        $validatedData['user_id'] = $user->id;
        $wanttowatchtvshow = WantToWatchTvShow::create($validatedData);

        return response()->json($wanttowatchtvshow, 201);
    }
    public function getwanttowatchtvshows()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $wanttowatchtvshows = WantTowatchTvShow::where('user_id', $user->id)->get();

        return response()->json($wanttowatchtvshows);
    }
    public function deletewanttowatchtvshows($title)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $wanttowatchtvshows = WantToWatchTvShow::where('wanttowatchtvshowtitle', $title)
                    ->where('user_id',$user->id)
                    ->first();

        if (!$wanttowatchtvshows) {
            return response()->json(['message' => 'tvshow not found'], 404);
        }

        $wanttowatchtvshows->delete();

        return response()->json(['message' => 'tvshow deleted successfully'], 200);
    }
}
