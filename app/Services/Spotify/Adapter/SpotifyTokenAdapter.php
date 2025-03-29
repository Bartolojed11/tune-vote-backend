<?php

namespace App\Services\Spotify\Adapter;

use App\Services\Music\Adapter\TokenAdapter;


class SpotifyTokenAdapter extends TokenAdapter
{
    /**
     * The endpoint the adapter/service will access
     *
     * @return string
     */
    protected function getEndpoint(): string
    {
        return 'api/token';
    }
}
