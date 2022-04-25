<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collections\Artwork;
use Jenssegers\ImageHash\ImageHash;
use Jenssegers\ImageHash\Implementations\AverageHash;
use Aic\Hub\Foundation\Exceptions\DetailedException;

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

        // return $hash->toHex();

        $searchResponse = $this->query(
            'getSearchParams',
            'getSearchResponse',
            'search',
            'images',
            null,
            [
                'boost' => false,
                'fields' => [
                    'id',
                    'artwork_ids',
                    'ahash',
                ],
                'query' => [
                    'bool' => [
                        'filter' => [
                            'term' => [
                                'id' => 'foobar',
                            ]
                        ],
                    ],
                ],
            ],
        );

        $images = $searchResponse['data'];

        return $images;
    }
}
