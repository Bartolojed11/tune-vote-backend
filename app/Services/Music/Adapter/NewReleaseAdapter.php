<?php

namespace App\Services\Music\Adapter;

use App\Services\Music\Client\NewReleaseClient;
use App\Services\Music\Client\TokenClient;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

abstract class NewReleaseAdapter implements NewReleaseClient
{
    private string $url;
    private string $token;

    /**
     * @param TokenClient $tokenClient
     * @param string $base_url
     * @param string|null $version
     */
    public function __construct(public TokenClient $tokenClient, public string $base_url, public ?string $version)
    {
        $this->url = "{$base_url}/{$version}/{$this->getEndpoint()}";
        $this->token = $tokenClient->accessToken();
        Log::info("New Release Adapter", [
            'url' => $this->url,
            'token_set' => $this->token ? 'Token Set' : 'Token not set'
        ]);
    }

    /**
     * The endpoint the adapter/service will access
     *
     * @return string
     */
    abstract protected function getEndpoint(): string;

    /**
     * Sends a request to the API to get latest music release
     *
     * @param integer $offset
     * @param integer $limit
     * @return array|null
     */
    public function get(int $offset = 0, int $limit = 50): ?array
    {
        $response = Http::withToken($this->token)->get($this->url, [
            'limit' => $limit,
            'offset' => $offset,
        ]);

        if ($response->failed()) {
            Log::error('New Release Adapter Request Fail', [
                'status' => $response->status(),
                'body' => $response->body(),
                'token_set' => $this->token ? 'Set' : 'Not Set',
            ]);
            return null;
        }

        return $response->json();
    }
}
