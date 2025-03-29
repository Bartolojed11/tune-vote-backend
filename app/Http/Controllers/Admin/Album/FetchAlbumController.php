<?php

namespace App\Http\Controllers\Admin\Album;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Album\AlbumService;

class FetchAlbumController extends Controller
{
    protected $albumService;

    public function __construct(AlbumService $albumService)
    {
        $this->albumService = $albumService;
    }

    public function __invoke(Request $request)
    {
        $search = $request->input('search');
        $albums = $this->albumService->getAlbums($search, 10);

        return response()->json([
            'message'   => 'Albums fetched successfully',
            'data'      => $albums,
            'status'    => true,
        ]);
    }
}
