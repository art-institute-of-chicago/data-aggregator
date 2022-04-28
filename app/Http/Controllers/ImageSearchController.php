<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Aic\Hub\Foundation\Exceptions\DetailedException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Library\Shell;

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

        $diskPath = 'tmp/' . uniqid() . '.jpg';
        $fullPath = storage_path('app/' . $diskPath);

        $image = Image::make($request->file);
        $image->save($fullPath);

        // TODO: Error out if the file is not an image
        $shell = new Shell([
            'is_silent' => true,
        ]);

        $result = $shell->exec(
            'python3 %s %s',
            base_path('bin/ahash.py'),
            $fullPath,
        );

        Storage::delete($diskPath);

        $hash = array_pop($result['output']);
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
                        'minimum_should_match' => '70%',
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

        // Returns multi-id response with empty `data`
        if (empty($artworkIds)) {
            $artworkIds = [
                1, // almost certainly will never exist
            ];
        }

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
