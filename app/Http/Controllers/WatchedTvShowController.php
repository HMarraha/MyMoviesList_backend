<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WatchedTvShow;

class WatchedTvShowController extends Controller
{
    public function watchedtvshows(Request $request)
    {
        $validatedData = $request->validate([
            'watchedtvshowimage' => 'unique:watched_tv_shows',
            'watchedtvshowtitle' => 'unique:watched_tv_shows',
            'watchedtvshowoverview' => 'unique:watched_tv_shows',
        ]);
        $watchedtvshow = WatchedTvShow::create($validatedData);

        return response()->json($watchedtvshow, 201);
    }

    public function getwatchedtvshows()
    {
        $watchedtvshows = WatchedTvShow::all();

        return response()->json($watchedtvshows);
    }
}
