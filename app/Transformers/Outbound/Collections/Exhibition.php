<?php

namespace App\Transformers\Outbound\Collections;

use App\Transformers\Outbound\Collections\Artwork as ArtworkTransformer;
use App\Transformers\Outbound\StaticArchive\Site as SiteTransformer;

use App\Transformers\Outbound\HasSuggestFields;

use App\Transformers\Outbound\CollectionsTransformer as BaseTransformer;

class Exhibition extends BaseTransformer
{

    use HasSuggestFields;

    protected $availableIncludes = [
        'artworks',
        'sites',
    ];

    public function includeArtworks($exhibition)
    {
        return $this->collection($exhibition->artworks, new ArtworkTransformer, false);
    }

    public function includeSites($exhibition)
    {
        return $this->collection($exhibition->sites, new SiteTransformer, false);
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
            'is_published' => [
                'doc' => 'Is this exhibition currently published on our website? Only relevant for non-past exhibitions.',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'value' => function ($item) {
                    return $item->webExhibition->is_published ?? false;
                },
            ],
            'description' => [
                'doc' => 'Explanation of what this exhibition is',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                    'type' => 'text',
                ],
            ],
            'short_description' => [
                'doc' => 'Brief explanation of what this exhibition is',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->webExhibition->list_description ?? $item->short_description;
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
            'type' => [
                'doc' => 'The type of exhibition. In particular this notes whether the exhibition was only displayed at the Art Institute or whether it traveled to other venues.',
                'type' => 'string',
                'elasticsearch' => 'keyword',
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
            'start_at' => [
                'doc' => 'Date the exhibition opened across multiple venues',
                'type' => 'ISO 8601 date and time',
                'value' => $this->getDateValue('date_start'),
            ],
            'end_at' => [
                'doc' => 'Date the exhibition closed across multiple venues',
                'type' => 'ISO 8601 date and time',
                'value' => $this->getDateValue('date_end'),
            ],
            'department_display' => [
                'doc' => 'The name of the department that primarily organized the exhibition',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],

            // TODO: Rename gallery_title to gallery_display, to accurately reflect that it's a free form display
            //       representation of the galleries an exhibition took place in.
            'gallery_id' => [
                'doc' => 'Unique identifier of the gallery that mainly housed the exhibition',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->gallery->citi_id ?? null;
                },
            ],
            'gallery_title' => [
                'doc' => 'The name of the gallery that mainly housed the exhibition',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->place_display;
                },
            ],

            // TODO: Refactor relationships:
            'artwork_ids' => [
                'doc' => 'Unique identifiers of the artworks that were part of the exhibition',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->artworks->pluck('citi_id');
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
                    return $item->artists->pluck('citi_id');
                },
            ],
            'site_ids' => [
                'doc' => 'Unique identifiers of the microsites this exhibition is a part of',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->sites->pluck('site_id');
                },
            ],
            'legacy_event_ids' => [
                'doc' => 'Unique identifiers of the legacy events featuring this exhibition. These are events that been '
                        .' imported from our existing site as a placeholder, until events from our new can be pulled in.',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->legacyEvents->pluck('membership_id');
                },
            ],
            // TODO: Shared fields w/ artwork – put into trait?
            'image_id' => [
                'doc' => 'Unique identifier of the preferred image to use to represent this exhibition',
                'type' => 'uuid',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->image->lake_guid ?? null;
                },
            ],
            'alt_image_ids' => [
                'doc' => 'Unique identifiers of all non-preferred images of this exhibition.',
                'type' => 'array',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->altImages->pluck('lake_guid');
                },
            ],
            'document_ids' => [
                'doc' => 'Unique identifiers of assets that serve as documentation for this exhibition',
                'type' => 'array',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->documents->pluck('lake_guid');
                },
            ],
            // EOF TODO
        ];
    }

}
