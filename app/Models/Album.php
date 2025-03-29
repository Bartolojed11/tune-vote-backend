<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    /** @use HasFactory<\Database\Factories\AlbumFactory> */
    use HasFactory;

    protected $primaryKey = 'album_id';

    // Allow mass assignment for these fields
    protected $fillable = [
        'user_id',
        'song_name',
        'artist_name',
        'album_cover'
    ];


    /**
     * Get the votes for the album.
     */
    public function votes()
    {
        return $this->hasMany(AlbumVote::class, 'album_id');
    }

    /**
     * Get the creator of the album.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor to sum up the total votes for the album.
     * You can use $album->total_votes in your code.
     */
    public function getTotalVotesAttribute()
    {
        return $this->votes->sum('vote');
    }
}
