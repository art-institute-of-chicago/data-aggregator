<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\ImageHash\ImageHash;
use Jenssegers\ImageHash\Implementations\AverageHash;
use Aic\Hub\Foundation\Exceptions\DetailedException;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SearchController as BaseController;

class ImageSearchController extends BaseController
{
    public function imageSearch(Request $request)
    {
        if (empty($request->file)) {
            throw new DetailedException(
                'Missing file parameter',
                'Expecting image file as base64 encoded string in `file` param',
                400,
            );
        }

        // TODO: Error out if the file is not an image

        $hasher = new ImageHash(new AverageHash());
        $hash = $hasher->hash($request->file);
        $hashBinaries = hexToBoolArray($hash, 64);

        $properties = collect()
            ->range(0, 63)
            ->map(fn ($i) => [
                'term' => [
                    'ahash.hash_' . $i => $hashBinaries[$i]
                ],
            ])
            ->all();

        $searchResponse = $this->query(
            'getSearchParams',
            'getSearchResponse',
            'search',
            'images',
            null,
            [
                'boost' => false,
                'fields' => [
                    'artwork_ids',
                ],
                'query' => [
                    'bool' => [
                        'minimum_should_match' => '80%',
                        'should' => $properties
                    ],
                ],
            ],
        );

        if (!is_array($searchResponse)) {
            throw new DetailedException(
                'Server error',
                'We encountered an issue while retrieving matching images',
                500,
            );
        }

        $images = $searchResponse['data'];

        $artworkIds = collect($images)
            ->pluck('artwork_ids')
            ->collapse()
            ->unique()
            ->values()
            ->all();

        $path = '/api/v1/artworks';

        // Get ServerBag of current reqest, rewrite URI, convert to array
        $server = request()->server;
        $server->set('REQUEST_URI', $path);
        $server = $server->all();

        // Rewrite the current request with one containing new URI and JSON
        $request = new Request([], [], [], [], [], $server, json_encode([
            'ids' => $artworkIds,
            'fields' => $request->fields ?? [],
        ]));

        app()->request = $request;

        // Now, calling request() returns the new request!
        $artworkResponse = Route::dispatch($request)->getContent();

        return response($artworkResponse)->header('Content-Type', 'application/json');
    }
}
