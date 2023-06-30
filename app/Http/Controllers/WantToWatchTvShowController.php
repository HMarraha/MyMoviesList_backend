<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WantToWatchTvShow;

class WantToWatchTvShowController extends Controller
{
    public function wanttowatchtvshows(Request $request)
    {
        $validatedData = $request->validate([
            'wanttowatchtvshowimage' => 'unique:want_to_watch_tv_shows',
            'wanttowatchtvshowtitle' => 'unique:want_to_watch_tv_shows',
            'wanttowatchtvshowoverview' => 'unique:want_to_watch_tv_shows',
        ]);
        $wanttowatchtvshow = WantToWatchTvShow::create($validatedData);

        return response()->json($wanttowatchtvshow, 201);
    }
    public function getwanttowatchtvshows()
    {
        $wanttowatchtvshows = WantTowatchTvShow::all();

        return response()->json($wanttowatchtvshows);
    }
    public function deletewanttowatchtvshows($title)
    {
        $wanttowatchtvshows = WantToWatchTvShow::where('wanttowatchtvshowtitle', $title)->first();

        if (!$wanttowatchtvshows) {
            return response()->json(['message' => 'tvshow not found'], 404);
        }

        $wanttowatchtvshows->delete();

        return response()->json(['message' => 'tvshow deleted successfully'], 200);
    }
}
