<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * A collection of audio tour stops to form a tour.
 */
class Tour extends MobileModel
{

    use ElasticSearchable;
    use Documentable;

    public function intro()
    {

        return $this->belongsTo('App\Models\Mobile\Sound', 'intro_mobile_id');

    }

    public function tourStops()
    {

        return $this->hasMany('App\Models\Mobile\TourStop', 'tour_mobile_id');

    }


    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'image',
                "doc" => "The main image for the tour",
                "type" => "url",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->image; },
            ],
            [
                "name" => 'description',
                "doc" => "Explanation of what the tour is",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->description; },
            ],
            [
                "name" => 'intro',
                "doc" => "Text introducing the tour",
                "type" => "string",
                "elasticsearch" => [
                    "default" => true,
                    "type" => 'text',
                ],
                "value" => function() { return $this->intro_text; },
            ],
            [
                "name" => 'weight',
                "doc" => "Number representing this tour's sort order",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->weight; },
            ],
            [
                "name" => 'intro_link',
                "doc" => "Link to the audio file of the introduction",
                "type" => "url",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->intro->link ?? null; },
            ],
            [
                "name" => 'intro_transcript',
                "doc" => "Transcript of the introduction audio to the tour",
                "type" => "string",
                "elasticsearch" => [
                    "default" => true,
                    "type" => 'text',
                ],
                "value" => function() { return $this->intro->transcript ?? null; },
            ],

            [
                "name" => 'artwork_titles',
                "doc" => "Names of the artworks featured in this tour's tour stops",
                "type" => "array",
                "elasticsearch" => [
                    "default" => true,
                ],
                "value" => function() {
                    return $this->tourStops->pluck('artwork')->pluck('artwork')->pluck('title')->filter()->values()->all();
                },
            ],
            [
                "name" => 'artist_titles',
                "doc" => "Names of the artists of the artworks featured in this tour's tour stops",
                "type" => "array",
                "elasticsearch" => [
                    "default" => true,
                ],
                "value" => function() {
                    return $this->tourStops->pluck('artwork')->pluck('artwork')->pluck('artists')->collapse()->pluck('title')->all();
                },
            ],

        ];

    }


    /**
     * Overrides method from ElasticSearchable. Tours should always contribute to autocomplete.
     *
     * @return array
     */
    public function getSuggestSearchFields()
    {

        return [
            'suggest_autocomplete_all' => $this->title,
            'suggest_autocomplete_boosted' => $this->title,
        ];

    }


    public function searchableImage()
    {

        return $this->image;

    }


    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "2219";

    }

}
