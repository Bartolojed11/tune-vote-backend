<?php

namespace App\Services\Music\Adapter\Traits\Token;

use Illuminate\Support\Facades\Cache;

trait TokenCache
{
    public string $token_cache_name = 'music_api_cache_token';

    /**
     * Cache the access token
     *
     * @param string $token
     * @return void
     */
    public function cacheToken(string $token): void
    {
        Cache::put($this->token_cache_name, $token, now()->addMinutes((int)config('music.credentials.life')));
    }

    /**
     *
     * @return string|null
     */
    public function getTokenFromCache(): ?string
    {
        return Cache::get($this->token_cache_name);
    }
}
