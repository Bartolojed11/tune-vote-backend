<?php

namespace App\Http\Controllers\Admin\Album;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlbumRequest;
use App\Models\Album;
use Exception;

class DeleteAlbumController extends Controller
{
    public function __invoke(AlbumRequest $request, Album $album)
    {
        try {
            // Attempt to delete the album. If deletion fails, delete() returns false.
            if (!$album->delete()) {
                throw new Exception("Failed to delete album: {$album->album_id}");
            }

            return response()->json([
                'message' => 'Album deleted successfully',
                'data'    => null,
                'status'  => true,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data'    => null,
                'status'  => false,
            ], 500);
        }
    }
}
