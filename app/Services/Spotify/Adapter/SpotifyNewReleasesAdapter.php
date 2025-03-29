<?php

namespace App\Services\Spotify\Adapter;

use App\Services\Music\Adapter\NewReleaseAdapter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SpotifyNewReleasesAdapter extends NewReleaseAdapter
{
    private string $cache_key = 'snra_';
    // Life of cache in minutes
    private int $life = 60;

    /**
     * The endpoint the adapter/service will access
     *
     * @return string
     */
    protected function getEndpoint(): string
    {
        return 'browse/new-releases';
    }

    /**
     * Get latest spotify release from cache, If not found-Send a request to the API to get latest spotify release
     *
     * @param integer $offset
     * @param integer $limit
     * @return array|null
     */
    public function get(int $offset = 0, int $limit = 50): ?array
    {
        $cache_key = "{$this->cache_key}_{$offset}_{$limit}";
        Log::info("New Release Cache: {$cache_key}");
        $cached_new_release = Cache::get($cache_key);

        if ($cached_new_release) {
            Log::info("Get new release from cache with cache key: {$cache_key}");
            return $cached_new_release;
        }

        $new_release = parent::get($offset, $limit);

        Cache::put($cache_key, $new_release, now()->addMinutes($this->life));

        return $new_release;
    }
}
