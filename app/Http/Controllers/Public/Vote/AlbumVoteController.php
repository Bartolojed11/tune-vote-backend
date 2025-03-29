<?php

namespace App\Http\Controllers\Public\Vote;

use App\Models\Album;
use App\Http\Controllers\Controller;
use App\Http\Requests\AlbumVoteRequest;
use App\Services\Album\AlbumVoteService;
use App\Models\User;


class AlbumVoteController extends Controller
{
    public function __construct(public AlbumVoteService $albumVoteService) {}

    public function __invoke(AlbumVoteRequest $request, Album $album)
    {
        $voteValue = $request->input('vote');
        $user = User::where('user_id', 2)->first();
        $vote = $this->albumVoteService->vote($album, $user, $voteValue);

        return response()->json([
            'message' => 'Vote registered successfully.',
            'data'    => $vote,
            'status'  => 'success'
        ]);
    }
}
