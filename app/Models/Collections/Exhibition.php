<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * An organized presentation and display of a selection of artworks.
 */
class Exhibition extends CollectionsModel
{

    use ElasticSearchable;
    use Documentable;

    protected $primaryKey = 'citi_id';

    public function getDates()
    {
        return array_merge( parent::getDates(), [
            'date_start',
            'date_end',
            'date_aic_start',
            'date_aic_end',
        ]);
    }

    public function artworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork');

    }

    public function venues()
    {

        return $this->hasMany('App\Models\Collections\AgentExhibition');

    }

    public function gallery()
    {

        return $this->belongsTo('App\Models\Collections\Gallery', 'place_citi_id');

    }

    public function sites()
    {

        return $this->belongsToMany('App\Models\StaticArchive\Site');

    }

    public function legacyEvents()
    {

        return $this->belongsToMany('App\Models\Membership\LegacyEvent', 'legacy_event_exhibition');

    }

    // TODO: Consider using hasManyThrough() or belongsToMany()->using()
    public function getArtistsAttribute()
    {

        return $this->sites->pluck('agents')->collapse()->unique();

    }

    // TODO: These relations are shared w/ artwork – consider moving them to e.g. Behaviors/HasRepAndDoc.php?
    // The only thing that changes is the pivot table – artwork_asset vs. exhibition_asset

    // SOF HasRepAndDoc --------------->

    public function images()
    {

        return $this->belongsToMany('App\Models\Collections\Asset', 'exhibition_asset')
            ->where('type', 'image') // Do we need these if we're targeting Image i/o Asset?
            ->withPivot('preferred')
            ->withPivot('is_doc')
            ->wherePivot('is_doc', '=', false);

    }

    public function image()
    {

        return $this->images()->isPreferred();

    }

    public function altImages()
    {

        return $this->images()->isAlternative();

    }

    public function assets()
    {

        return $this->belongsToMany('App\Models\Collections\Asset', 'exhibition_asset')->withPivot('is_doc');

    }

    public function documents()
    {

        return $this->assets()->wherePivot('is_doc', '=', true);

    }

    // EOF HasRepAndDoc --------------->


    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'description',
                "doc" => "Explanation of what this exhibition is",
                "type" => "string",
                "elasticsearch" => [
                    "default" => true,
                    "type" => 'text',
                ],
                "value" => function() { return $this->description; },
            ],
            [
                "name" => 'short_description',
                "doc" => "Brief explanation of what this exhibition is",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->short_description; },
            ],
            [
                "name" => 'web_url',
                "doc" => "URL to this exhibition on our website",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->web_url; },
            ],
            [
                "name" => 'type',
                "doc" => "The type of exhibition. In particular this notes whether the exhibition was only displayed at the Art Institute or whether it traveled to other venues.",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->type; },
            ],
            [
                "name" => 'status',
                "doc" => "Whether the exhibition is open or closed",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->status; },
            ],
            [
                "name" => 'aic_start_at',
                'doc' => "Date the exhibition opened at the Art Institute of Chicago",
                "type" => "ISO 8601 date and time",
                'value' => function() { return $this->date_aic_start ? $this->date_aic_start->toIso8601String() : NULL; },
            ],
            [
                "name" => 'aic_end_at',
                'doc' => "Date the exhibition closed at the Art Institute of Chicago",
                "type" => "ISO 8601 date and time",
                'value' => function() { return $this->date_aic_end ? $this->date_aic_end->toIso8601String() : NULL; },
            ],
            [
                "name" => 'start_at',
                'doc' => "Date the exhibition opened across multiple venues",
                "type" => "ISO 8601 date and time",
                'value' => function() { return $this->date_start ? $this->date_start->toIso8601String() : NULL; },
            ],
            [
                "name" => 'end_at',
                'doc' => "Date the exhibition closed across multiple venues",
                "type" => "ISO 8601 date and time",
                'value' => function() { return $this->date_end ? $this->date_end->toIso8601String() : NULL; },
            ],
            [
                "name" => 'department_display',
                "doc" => "The name of the department that primarily organized the exhibition",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->department_display; },
            ],
            // TODO: Rename gallery_title to gallery_display, to accurately reflect that it's a free form display
            //       representation of the galleries an exhibition took place in.
            [
                "name" => 'gallery_id',
                "doc" => "Unique identifier of the gallery that mainly housed the exhibition",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->gallery ? $this->gallery->citi_id : null; },
            ],
            [
                "name" => 'gallery_title',
                "doc" => "The name of the gallery that mainly housed the exhibition",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->place_display; },
            ],
            [
                "name" => 'legacy_image_desktop_url',
                "doc" => "URL to the desktop hero image from the legacy marketing site",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->legacy_image_desktop; },
            ],
            [
                "name" => 'legacy_image_mobile_url',
                "doc" => "URL to the mobile hero image from the legacy marketing site",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->legacy_image_mobile; },
            ],
            [
                "name" => 'artwork_ids',
                "doc" => "Unique identifiers of the artworks that were part of the exhibition",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->artworks->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'venue_ids',
                "doc" => "Unique identifiers of the venue agent records representing who hosted the exhibition",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->venues->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'artist_ids',
                "doc" => "Unique identifiers of the artist agent records representing who was shown in the exhibition",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->artists->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'site_ids',
                "doc" => "Unique identifiers of the microsites this exhibition is a part of",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->sites->pluck('site_id')->all(); },
            ],
            [
                "name" => 'legacy_event_ids',
                "doc" => "Unique identifiers of the legacy events featuring this exhibition. These are events that been "
                        ." imported from our existing site as a placeholder, until events from our new can be pulled in.",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->legacyEvents->pluck('membership_id')->all(); },
            ],
            // TODO: Shared fields w/ artwork – put into trait?
            [
                "name" => 'image_id',
                "doc" => "Unique identifier of the preferred image to use to represent this exhibition",
                "type" => "uuid",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->image->lake_guid ?? null; },
            ],
            [
                "name" => 'alt_image_ids',
                "doc" => "Unique identifiers of all non-preferred images of this exhibition.",
                "type" => "array",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->altImages->pluck('lake_guid')->all(); },
            ],
            [
                "name" => 'document_ids',
                "doc" => "Unique identifiers of assets that serve as documentation for this exhibition",
                "type" => "array",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->documents->pluck('lake_guid')->all(); },
            ],
            // EOF TODO
        ];

    }


    /**
     * Turn the titles for related models into a generic array
     *
     * @return array
     */
    protected function transformTitles()
    {

        return [

            [
                "name" => 'artwork_titles',
                "doc" => "Names of the artworks that were part of the exhibition",
                "type" => "array",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->artworks->pluck('title')->all(); },
            ],
            [
                "name" => 'venue_titles',
                "doc" => "Names of the venue agent records representing who hosted the exhibition",
                "type" => "array",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->venues->pluck('title')->all(); },
            ],

        ];

    }


    public function getExtraFillFieldsFrom($source)
    {

        return [
            'type' => $source->exhibition_type,
            'status' => $source->exhibition_status,
            'place_citi_id' => $source->gallery_id,
            'place_display' => $source->gallery,
            'date_start' => $source->start_date ? strtotime($source->start_date) : null,
            'date_end' => $source->end_date ? strtotime($source->end_date) : null,
            'date_aic_start' => $source->aic_start_date ? strtotime($source->aic_start_date) : null,
            'date_aic_end' => $source->aic_end_date ? strtotime($source->aic_end_date) : null,
            'source_indexed_at' => strtotime($source->indexed_at),
        ];

    }


    public function attachFrom($source)
    {

        $this->venues()->saveMany(AgentExhibition::findMany($source->exhibition_agent_ids));
        $this->artworks()->sync($source->artwork_ids);

        // TODO: This logic is shared w/ artworks - consider abstracting it elsewhere?
        $assets = collect( $source->alt_image_guids ?? [] )->map( function( $asset ) {
            return [
                $asset => [
                    'preferred' => false,
                    'is_doc' => false,
                ]
            ];
        });

        if ($source->image_guid)
        {

            $assets->push([
                $source->image_guid => [
                    'preferred' => true,
                    'is_doc' => false,
                ]
            ]);

        }

        // TODO: Shared logic w/ exhibitions - abstract?
        if ($source->document_ids)
        {

            $documents = collect( $source->document_ids )->map( function( $document ) {
                return [
                    $document => [
                        'preferred' => false,
                        'is_doc' => true,
                    ]
                ];
            });

            $assets = $assets->concat( $documents );

        }

        // This only works for string keys!
        $assets = $assets->collapse();

        $this->assets()->sync($assets);

    }


    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "1302";

    }

    /**
     * Get the subresources for the resource.
     *
     * @return array
     */
    public function subresources()
    {

        return ['artworks', 'venues'];

    }

}
