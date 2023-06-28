<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchingMovie extends Model
{
    use HasFactory;

    protected $fillable = ['watchingimage', 'watchingtitle', 'watchingoverview'];
}
