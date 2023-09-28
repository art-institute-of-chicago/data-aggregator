<?php

namespace App\Transformers\Outbound\Collections;

use App\Models\Collections\Asset;
use App\Transformers\Outbound\Collections\Artwork as ArtworkTransformer;
use App\Transformers\Outbound\StaticArchive\Site as SiteTransformer;
use App\Transformers\Outbound\HasSuggestFields;
use App\Transformers\Outbound\Collections\Traits\IsCC0;
use App\Transformers\Outbound\CollectionsTransformer as BaseTransformer;

class Exhibition extends BaseTransformer
{
    use IsCC0;
    use HasSuggestFields;

    protected $availableIncludes = [
        'artworks',
        'sites',
    ];

    public function includeArtworks($exhibition)
    {
        return $this->collection($exhibition->artworks, new ArtworkTransformer(), false);
    }

    public function includeSites($exhibition)
    {
        return $this->collection($exhibition->sites, new SiteTransformer(), false);
    }

    protected function getFields()
    {
        return [
            'is_featured' => [
                'doc' => 'Is this exhibition currently featured on our website?',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'value' => function ($item) {
                    return $item->webExhibition->is_featured ?? false;
                },
            ],
            'position' => [
                'doc' => 'Numering position represnting the order in which this exhibition is featured on the website',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->webExhibition->position ?? -1;
                },
            ],
            'is_published' => [
                'doc' => 'Is this exhibition currently published on our website? Only relevant for non-past exhibitions.',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'value' => function ($item) {
                    return $item->webExhibition !== null;
                },
                'is_restricted' => true,
            ],
            'short_description' => [
                'doc' => 'Brief explanation of what this exhibition is',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->webExhibition->list_description ?? null;
                },
            ],
            'web_url' => [
                'doc' => 'URL to this exhibition on our website',
                'type' => 'string',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->webExhibition->web_url ?? null;
                },
            ],
            'image_url' => [
                'doc' => 'URL to the hero image from the website',
                'type' => 'string',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->webExhibition->image_url ?? null;
                },
            ],
            'status' => [
                'doc' => 'Whether the exhibition is open or closed',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'aic_start_at' => [
                'doc' => 'Date the exhibition opened at the Art Institute of Chicago',
                'type' => 'ISO 8601 date and time',
                'value' => $this->getDateValue('date_aic_start'),
            ],
            'aic_end_at' => [
                'doc' => 'Date the exhibition closed at the Art Institute of Chicago',
                'type' => 'ISO 8601 date and time',
                'value' => $this->getDateValue('date_aic_end'),
            ],

            'gallery_id' => [
                'doc' => 'Unique identifier of the gallery that mainly housed the exhibition',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->gallery->id ?? null;
                },
            ],
            'gallery_title' => [
                'doc' => 'The name of the gallery that mainly housed the exhibition',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->gallery->title ?? null;
                },
            ],

            // TODO: Refactor relationships:
            'artwork_ids' => [
                'doc' => 'Unique identifiers of the artworks that were part of the exhibition',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->artworks->pluck('id');
                },
            ],
            'artwork_titles' => [
                'doc' => 'Names of the artworks that were part of the exhibition',
                'type' => 'array',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->artworks->pluck('title');
                },
            ],
            'artist_ids' => [
                'doc' => 'Unique identifiers of the artist agent records representing who was shown in the exhibition',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->artists->pluck('id');
                },
            ],
            'site_ids' => [
                'doc' => 'Unique identifiers of the microsites this exhibition is a part of',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->sites->pluck('id');
                },
            ],
            // TODO: Shared fields w/ artwork – put into trait?
            'image_id' => [
                'doc' => 'Unique identifier of the preferred image to use to represent this exhibition',
                'type' => 'uuid',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return Asset::getHashedId($item->image->id ?? null);
                },
            ],
            'alt_image_ids' => [
                'doc' => 'Unique identifiers of all non-preferred images of this exhibition.',
                'type' => 'array',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->altImages->pluck('id')->map(function ($id) {
                        return Asset::getHashedId($id);
                    });
                },
            ],
            'document_ids' => [
                'doc' => 'Unique identifiers of assets that serve as documentation for this exhibition',
                'type' => 'array',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->documents->pluck('id')->map(function ($id) {
                        return Asset::getHashedId($id);
                    });
                },
            ],
            // EOF TODO
        ];
    }
}
