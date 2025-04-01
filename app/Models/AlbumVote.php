<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumVote extends Model
{
    /** @use HasFactory<\Database\Factories\AlbumVoteFactory> */
    use HasFactory;

    protected $primaryKey = 'album_vote_id';

    // Allow mass assignment for these fields
    protected $fillable = [
        'album_id',
        'user_id',
        'vote'
    ];

    /**
     * Get the album associated with the vote.
     */
    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    /**
     * Get the user who voted.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
