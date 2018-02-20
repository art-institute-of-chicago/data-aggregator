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
    protected $dates = ['date_start', 'date_end', 'date_aic_start', 'date_aic_end', 'source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

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

        return $this->belongsTo('App\Models\Collections\Place', 'place_citi_id');

    }

    public function sites()
    {

        return $this->belongsToMany('App\Models\StaticArchive\Site');

    }

    public function legacyEvents()
    {

        return $this->belongsToMany('App\Models\Membership\LegacyEvent', 'legacy_event_exhibition');

    }

    public function getArtistsAttribute()
    {

        return $this->sites->pluck('agents')->collapse()->unique();

    }


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
            [
                "name" => 'gallery_title',
                "doc" => "The name of the gallery that mainly housed the exhibition",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->gallery()->getResults() ? $this->gallery()->getResults()->title : $this->gallery_display; },
            ],
            [
                "name" => 'gallery_id',
                "doc" => "Unique identifier of the gallery that mainly housed the exhibition",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->gallery ? $this->gallery->citi_id : null; },
            ],
            [
                "name" => 'image_id',
                "doc" => "Unique identifier of the image to use to represent this exhibition",
                "type" => "uuid",
                'elasticsearch_type' => 'keyword',
                "value" => function() {
                    return $this->asset_lake_guid;
                },
            ],
            [
                "name" => 'image_iiif_url',
                "doc" => "IIIF URL of the image to use to represent this exhibition",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() {
                    return $this->image_iiif_url;
                },
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
                "value" => function() { return $this->venues->pluck('id')->all(); },
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

        // Galleries must be imported before exhibitions!
        // Waiting on Redmine #2000 to do this properly
        $gallery = Place::where('title', $source->gallery)->first();

        return [
            'type' => $source->exhibition_type,
            'status' => $source->exhibition_status,
            'asset_lake_guid' => $source->image_guid,
            // TODO: Use actual gallery_id in $source?
            // TODO: Remove the place_display field
            'place_citi_id' => $gallery ? $gallery->citi_id : null,
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
        $this->artworks()->sync($source->artwork_ids, false);

        // TODO: Add documents, i.e. links to assets, e.g. exhibition catalogues
        // $source->document_ids

    }


    /**
     * Get the IIIF URL of the image representing this exhibition. Corresponds to the `@id` attribute in the image's `/info.json`
     *
     * @TODO Currently, this redirects to a non-existent `info.json'
     *
     * @return string
     */
    public function getImageIiifUrlAttribute()
    {

        return $this->asset_lake_guid ? (env('IIIF_URL', 'https://localhost/iiif') . '/' . $this->asset_lake_guid) : null;

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
