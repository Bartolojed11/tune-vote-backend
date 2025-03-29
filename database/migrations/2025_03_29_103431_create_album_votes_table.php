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
        Schema::create('album_votes', function (Blueprint $table) {
            $table->id('album_vote_id');
            $table->foreignId('album_id')->references('album_id')->on('albums')->onDelete('cascade');
            $table->foreignId('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->unique(['album_id', 'user_id']);
            // Vote: 1 for upvote, -1 for downvote
            $table->tinyInteger('vote');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_votes');
    }
};
