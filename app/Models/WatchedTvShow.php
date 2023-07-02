<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchedTvShow extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','watchedtvshowimage', 'watchedtvshowtitle', 'watchedtvshowoverview'];
}
