<?php

namespace App\Services\Album;

use App\Models\Album;

class AlbumService
{
    /**
     * Get paginated and filtered albums sorted by votes and then alphabetically.
     *
     * @param string|null $search Optional search term for filtering albums by song or artist name.
     * @param int         $perPage Number of albums per page for pagination.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator Paginated result of albums.
     */
    public function getAlbums(?string $search = null, int $perPage = 10)
    {
        // Use withSum() to calculate the total votes for each album.
        // The votes relationship should exist on the Album model.
        $query = Album::withSum('votes', 'vote');

        // Apply search filter if provided.
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('song_name', 'LIKE', "%{$search}%")
                    ->orWhere('artist_name', 'LIKE', "%{$search}%");
            });
        }

        // Sort the albums:
        // 1. Order by total votes (descending)
        // 2. For albums with the same vote total, order alphabetically by song name.
        $query->orderByDesc('votes_sum_vote')->orderBy('song_name');

        // Return paginated result
        return $query->paginate($perPage)->appends(['search' => $search]);
    }
}
