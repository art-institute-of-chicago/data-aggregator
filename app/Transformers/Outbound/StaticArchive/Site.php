<?php

namespace App\Transformers\Outbound\StaticArchive;

use App\Transformers\Outbound\Collections\Artwork as ArtworkTransformer;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Site extends BaseTransformer
{

    protected $availableIncludes = ['artworks'];

    public function includeArtworks($site)
    {
        return $this->collection($site->artworks, new ArtworkTransformer(), false);
    }

    protected function getFields()
    {
        return [
            'description' => [
                'doc' => 'Explanation of what this site is',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                    'type' => 'text',
                ],
            ],
            'web_url' => [
                'doc' => 'URL to this site',
                'type' => 'url',
                'elasticsearch' => 'keyword',
            ],

            // TODO: Refactor relationships:
            'exhibition_ids' => [
                'doc' => 'Unique identifier of the exhibitions this site is associated with',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->exhibitions->pluck('citi_id');
                },
            ],
            'exhibition_titles' => [
                'doc' => 'Names of the exhibitions this site is associated with',
                'type' => 'array',
                'elasticsearch' => [
                    'default' => true,
                    'type' => 'text',
                ],
                'value' => function ($item) {
                    return $item->exhibitions->pluck('title');
                },
            ],
            'artist_ids' => [
                'doc' => 'Unique identifiers of the artists this site is associated with',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->agents->pluck('citi_id');
                },
            ],
            'artist_titles' => [
                'doc' => 'Names of the artists this site is associated with',
                'type' => 'array',
                'value' => function ($item) {
                    return $item->agents->pluck('title');
                },
            ],
            'artwork_ids' => [
                'doc' => 'Unique identifiers of the artworks this site is associated with',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->artworks->pluck('citi_id');
                },
            ],
            'artwork_titles' => [
                'doc' => 'Names of the artworks this site is associated with',
                'type' => 'array',
                'elasticsearch' => [
                    'default' => true,
                    'type' => 'text',
                ],
                'value' => function ($item) {
                    return $item->artworks->pluck('title');
                },
            ],
        ];
    }
}
