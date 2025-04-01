<?php

namespace App\Providers;

use App\Services\Music\Client\TokenClient;
use App\Services\Music\Client\NewReleaseClient;
use App\Services\Spotify\Adapter\SpotifyNewReleasesAdapter;
use App\Services\Spotify\Adapter\SpotifyTokenAdapter;
use Illuminate\Support\ServiceProvider;

class MusicServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(TokenClient::class, function ($app) {
            return new SpotifyTokenAdapter(
                config('music.token_base_url'),
                config('music.credentials.grant_type'),
                config('music.credentials.client'),
                config('music.credentials.secret'),
                config('music.version'),
            );
        });

        $this->app->bind(NewReleaseClient::class, function ($app) {
            return new SpotifyNewReleasesAdapter(
                $app->make(TokenClient::class),
                config('music.base_url'),
                config('music.version')
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
