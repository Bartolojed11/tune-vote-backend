<?php

namespace App\Services\Album;

use App\Models\Album;
use App\Models\AlbumVote;
use App\Models\User;

class AlbumVoteService
{
    public const VOTE_OPTIONS = [
        'UP' => 1,
        'DOWN' => -1
    ];

    /**
     * Cast a vote for an album.
     *
     * @param Album $album The album to vote on.
     * @param User  $user The user casting the vote.
     * @param string   $voteValue The vote value
     * @return int
     *
     * @throws \InvalidArgumentException If the vote value is invalid.
     */
    public function vote(Album $album, User $user, string $voteValue): int
    {
        return AlbumVote::upsert([
            ['album_id' => $album->album_id, 'user_id' => $user->user_id, 'vote' => self::VOTE_OPTIONS[$voteValue]]
        ], uniqueBy: ['album_id', 'user_id'], update: ['vote']);
    }
}
