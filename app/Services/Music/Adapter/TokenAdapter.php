<?php

namespace App\Services\Music\Adapter;

use App\Services\Music\Adapter\Traits\Token\TokenCache;
use App\Services\Music\Client\TokenClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

abstract class TokenAdapter implements TokenClient
{
    use TokenCache;

    // Complete url the adapter will be accessing
    private string $url;

    /**
     *
     * @param string $base_url
     * @param string $grant_type
     * @param string $client_id
     * @param string $client_secret
     */
    public function __construct(public string $base_url, public string $grant_type, public string $client_id, public string $client_secret)
    {
        $this->url = "{$base_url}/{$this->getEndpoint()}";
    }

    /**
     * The endpoint the adapter/service will access
     *
     * @return string
     */
    abstract protected function getEndpoint(): string;

    /**
     * Generate token by sending payload
     *
     * @return string|null
     */
    public function requestToken(): ?string
    {
        $response = Http::asForm()->post($this->url, [
            'grant_type' => $this->grant_type,
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
        ]);


        if ($response->failed()) {
            Log::error('Failed to generate access token', [
                'url' => $this->url,
                'grant_type' => $this->grant_type,
                'client_id_set' => $this->client_id ? 'Set' : 'Not Set',
                'client_secret_set' => $this->client_secret ? 'Set' : 'Not Set'
            ]);

            return null;
        }

        $this->cacheToken($response->json()['access_token'] ?? '');

        return $this->getTokenFromCache();
    }

    /**
     * Get access token stored in cache, if not found request a token to the API
     *
     * @return string|null
     */
    public function accessToken(): ?string
    {
        $tokenFromCache = $this->getTokenFromCache();
        $token = $tokenFromCache ?? $this->requestToken();

        if ($token) {
            $this->cacheToken($token);
        }

        return $token;
    }
}
