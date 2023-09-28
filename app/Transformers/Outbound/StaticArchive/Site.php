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
                    return $item->exhibitions->pluck('id');
                },
            ],
            'exhibition_titles' => [
                'doc' => 'Names of the exhibitions this site is associated with',
                'type' => 'array',
                'elasticsearch' => [
                    'default' => true,
                ],
                'value' => function ($item) {
                    return $item->exhibitions->pluck('title');
                },
            ],
            'artwork_ids' => [
                'doc' => 'Unique identifiers of the artworks this site is associated with',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->artworks->pluck('id');
                },
            ],
            'artwork_titles' => [
                'doc' => 'Names of the artworks this site is associated with',
                'type' => 'array',
                'elasticsearch' => [
                    'default' => true,
                ],
                'value' => function ($item) {
                    return $item->artworks->pluck('title');
                },
            ],
        ];
    }
}
