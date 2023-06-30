<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WatchingTvShow;

class WatchingTvShowController extends Controller
{
    public function watchingtvshows(Request $request)
    {
        $validatedData = $request->validate([
            'watchingtvshowimage' => 'unique:watching_tv_shows',
            'watchingtvshowtitle' => 'unique:watching_tv_shows',
            'watchingtvshowoverview' => 'unique:watching_tv_shows',
        ]);
        $watchingtvshow = WatchingTvShow::create($validatedData);

        return response()->json($watchingtvshow, 201);
    }
    public function getwatchingtvshows()
    {
        $watchingtvshows = WatchingTvShow::all();

        return response()->json($watchingtvshows);
    }
    public function deletewatchingtvshows($title) 
    {
        $watchingtvshows = WatchingTvShow::where('watchingtvshowtitle', $title)->first();

        if (!$watchingtvshows) {
            return response()->json(['message' => 'tvshow not found'], 404);
        }

        $watchingtvshows->delete();

        return response()->json(['message' => 'tvshow deleted successfully'], 200);
    }
}
