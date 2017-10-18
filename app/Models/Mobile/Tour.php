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

    public function stops()
    {

        return $this->hasMany('App\Models\Mobile\TourStop', 'tour_mobile_id');

    }


    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            'image' => [
                "doc" => "The main image for the tour",
                "value" => function() { return $this->image; },
            ],
            'description' => [
                "doc" => "Explanation of what the tour is",
                "value" => function() { return $this->description; },
            ],
            'intro' => [
                "doc" => "Text introducing the tour",
                "value" => function() { return $this->intro_text; },
            ],
            'weight' => [
                "doc" => "Number representing this tour's sort order",
                "value" => function() { return $this->weight; },
            ],
            'intro_link' => [
                "doc" => "Link to the audio file of the introduction",
                "value" => function() { return $this->intro->link; },
            ],
            'intro_transcript' => [
                "doc" => "Transcipt of the introduction audio to the tour",
                "value" => function() { return $this->intro->transcript; },
            ],
        ];

    }


    /**
     * Generate model-specific fields for an array representing the schema for this object.
     *
     * @return array
     */
    public function elasticsearchMappingFields()
    {

        return
            [
                'image' => [
                    'type' => 'keyword',
                ],
                'intro' => [
                    'type' => 'text',
                ],
                'weight' => [
                    'type' => 'integer',
                ],
                'intro_link' => [
                    'type' => 'keyword',
                ],
                'intro_transcript' => [
                    'type' => 'text',
                ],
            ];

    }

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "2280";

    }

}
