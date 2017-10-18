<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * An audio tour stops on a tour.
 */
class TourStop extends MobileModel
{

    use ElasticSearchable;
    use Documentable;

    protected $primaryKey = 'id';

    public function tour()
    {

        return $this->belongsTo('App\Models\Mobile\Tour', 'tour_mobile_id');

    }

    public function artwork()
    {

        return $this->belongsTo('App\Models\Mobile\Artwork', 'mobile_artwork_mobile_id');

    }

    public function sound()
    {

        return $this->belongsTo('App\Models\Mobile\Sound', 'mobile_sound_mobile_id');

    }


    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            // TODO: Determine if tour stops have dedicated titles?
            'title' => [
                "doc" => "Name of this tour stop",
                "value" => function() { return $this->artwork->title; },
            ],
            'artwork' => [
                "doc" => "Name of the artwork for this tour stop",
                "value" => function() { return $this->artwork->title; },
            ],
            'artwork_id' => [
                "doc" => "Unique identifier of the artwork for this tour stop",
                "value" => function() { return $this->artwork->artwork->id; },
            ],
            'mobile_sound' => [
                "doc" => "URL to the audio file for this tour stop",
                "value" => function() { return $this->sound->link; },
            ],
            'mobile_sound_id' => [
                "doc" => "Unique identifier of the audio file for this tour stop",
                "value" => function() { return $this->sound->id; },
            ],
            'weight' => [
                "doc" => "Number representing this tour stop's sort order",
                "value" => function() { return $this->weight; },
            ],
            'description' => [
                "doc" => "Explanation of what this tour stop is",
                "value" => function() { return $this->description; },
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
                'artwork' => [
                    'type' => 'text',
                ],
                'artwork_id' => [
                    'type' => 'integer',
                ],
                'mobile_sound' => [
                    'type' => 'keyword',
                ],
                'mobile_sound_id' => [
                    'type' => 'integer',
                ],
                'weight' => [
                    'type' => 'integer',
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

        return "2320";

    }

}
