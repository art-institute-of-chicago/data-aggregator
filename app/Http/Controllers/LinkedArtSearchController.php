<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SearchController as BaseController;

class LinkedArtSearchController extends BaseController
{
    public function search(Request $request, $resource = null)
    {
        $resource = $resource ?? 'artworks';

        $searchResponse = $this->query(
            'getSearchParams',
            'getSearchResponse',
            'search',
            $resource,
            null,
            [
                'boost' => false,
                'fields' => [
                    'id',
                    'title',
                    'date_display',
                    'thumbnail',
                    'image_id',
                    'api_model',
                    'artist_pivots',
                    'artist_title',
                    'artist_display',
                    'main_reference_number',
                    'is_public_domain',
                    'is_on_view',
                    'department_title',
                    'date_start',
                    'date_end',
                    'place_of_origin',
                    'medium_display',
                ],
            ],
        );

        $artworks = $searchResponse['data'];

        $artworkIds = collect($artworks)
            ->pluck('id')
            ->unique()
            ->values()
            ->all();

        // Returns multi-id response with empty `data`
        if (empty($artworkIds)) {
            $artworkIds = [
                1, // almost certainly will never exist
            ];
        }

        $path = '/la/v1/objects';

        // Get ServerBag of current reqest, rewrite URI, convert to array
        $server = request()->server;
        $server->set('REQUEST_URI', $path);
        $server = $server->all();

        // Rewrite the current request with one containing new URI and JSON
        $request = new Request(['ids' => implode(',', $artworkIds)], [], [], [], [], $server, json_encode([
            'fields' => $request->fields ?? [],
        ]));

        app()->request = $request;

        // Now, calling request() returns the new request!
        $artworkResponse = Route::dispatch($request)->getContent();

        return response($artworkResponse)->header('Content-Type', 'application/json');
    }
}
