<?php

namespace App\Services\Music\Client;

interface TokenClient
{
    /**
     *
     * @param string $base_url
     * @param string $grant_type
     * @param string $client_id
     * @param string $client_secret
     */
    public function __construct(string $base_url, string $grant_type, string $client_id, string $client_secret);

    /**
     * Generate token by sending required payload to the API
     *
     * @return string|null
     */
    public function requestToken(): ?string;

    /**
     * Get access token stored in cache, if not found request a token to the API
     *
     * @return string|null
     */
    public function accessToken(): ?string;

    /**
     * Cache the access token
     *
     * @param string $token
     * @return void
     */
    public function cacheToken(string $token): void;
}
