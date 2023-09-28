<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Aic\Hub\Foundation\Exceptions\DetailedException;
use Illuminate\Support\Facades\Route;
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

        $supportedHashes = ['ahash', 'phash'];

        if (!empty($request->hash_type)) {
            if (!in_array($request->hash_type, $supportedHashes)) {
                throw new DetailedException(
                    'Hash type not found',
                    'Only ahash and phash hash types are allowed',
                    400,
                );
            }

            $hashType = $request->hash_type;
        } else {
            $hashType = 'ahash';
        }

        Image::configure(['driver' => 'imagick']);

        $image = Image::make($request->file);
        $stream = $image->stream('jpg');

        $tempFile = tmpfile();
        stream_copy_to_stream($stream->detach(), $tempFile);

        $tempPath = stream_get_meta_data($tempFile)['uri'];

        // TODO: Error out if the file is not an image
        $shell = new Shell([
            'is_silent' => true,
        ]);

        $result = $shell->exec(
            '%s %s %s',
            base_path('venv/bin/python3'),
            base_path('bin/' . $hashType . '.py'),
            $tempPath,
        );

        fclose($tempFile);

        $hash = array_pop($result['output']);
        $hashBinaries = hexToBoolArray($hash, 64);

        $properties = collect()
            ->range(0, 63)
            ->map(fn ($i) => [
                'term' => [
                    $hashType . '.hash_' . $i => $hashBinaries[$i]
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
