<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('want_to_watch_movies', function (Blueprint $table) {
            $table->id();
            $table->string('wanttowatchimage')->nullable();
            $table->string('wanttowatchtitle')->nullable();
            $table->text('wanttowatchoverview')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('want_to_watch_movies');
    }
};
