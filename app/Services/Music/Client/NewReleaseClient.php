<?php

namespace App\Services\Music\Client;

use App\Services\Music\Client\TokenClient;

interface NewReleaseClient
{
    /**
     * @param TokenClient $tokenClient
     * @param string $base_url
     * @param string|null $version
     */
    public function __construct(TokenClient $tokenClient, string $base_url, ?string $version);

    /**
     * Sends a request to the API to get latest spotify release
     *
     * @param integer $offset
     * @param integer $limit
     * @return array|null
     */
    public function get(int $offset = 0, int $limit = 50): ?array;
}
