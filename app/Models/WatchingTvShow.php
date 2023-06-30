<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchingTvShow extends Model
{
    use HasFactory;

    protected $fillable = ['watchingtvshowimage', 'watchingtvshowtitle', 'watchingtvshowoverview'];
}