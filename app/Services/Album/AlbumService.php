<?php

namespace App\Services\Album;

use App\Models\Album;
use App\Models\User;

class AlbumService
{
    /**
     * Get paginated and filtered albums sorted by votes and then alphabetically.
     *
     * @param string|null $search Optional search term for filtering albums by song or artist name.
     * @param int         $perPage Number of albums per page for pagination.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator Paginated result of albums.
     */
    public function getAlbums(?string $search = null, int $perPage = 5, ?User $user = null)
    {
        return Album::withSum('votes', 'vote') // Get total votes
            ->when($user, function ($query) use ($user) {
                $query->with(['votes' => function ($q) use ($user) {
                    $q->where('user_id', $user?->user_id);
                }]);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('song_name', 'LIKE', "%{$search}%")
                        ->orWhere('artist_name', 'LIKE', "%{$search}%");
                });
            })
            ->orderByDesc('votes_sum_vote')->orderBy('song_name')
            ->paginate($perPage)->appends(['search' => $search]);
    }
}
