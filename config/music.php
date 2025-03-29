<?php

return [
    'credentials' => [
        'client' => env('MUSIC_API_CLIENT_ID', ''),
        'secret' => env('MUSIC_API_CLIENT_SECRET', ''),
        'grant_type' => env('MUSIC_API_GRANT_TYPE', 'client_credentials'),
        'life' => env('MUSIC_API_TOKEN_LIFE', 60)
    ],
    'token_base_url' => env('MUSIC_API_BASE_TOKEN_URL', ''),
    'base_url' => env('MUSIC_API_BASE_URL', ''),
    'version' => env('MUSIC_API_VERSION', ''),
];
