<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WantToWatchMovie extends Model
{
    use HasFactory;

    protected $fillable = [ 'wanttowatchimage', 'wanttowatchtitle', 'wanttowatchoverview'];
}
