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
                "type" => "string",
                "value" => function() { return $this->artwork ? $this->artwork->title : NULL; },
            ],
            'artwork' => [
                "doc" => "Name of the artwork for this tour stop",
                "type" => "string",
                "value" => function() { return $this->artwork ? $this->artwork->title : NULL; },
            ],
            'artwork_id' => [
                "doc" => "Unique identifier of the artwork for this tour stop",
                "type" => "number",
                "value" => function() { return $this->artwork && $this->artwork->artwork ? $this->artwork->artwork->id : NULL; },
            ],
            'mobile_sound' => [
                "doc" => "URL to the audio file for this tour stop",
                "type" => "url",
                "value" => function() { return $this->sound ? $this->sound->link : NULL; },
            ],
            'mobile_sound_id' => [
                "doc" => "Unique identifier of the audio file for this tour stop",
                "type" => "number",
                "value" => function() { return $this->sound ? $this->sound->id : NULL; },
            ],
            'weight' => [
                "doc" => "Number representing this tour stop's sort order",
                "type" => "number",
                "value" => function() { return $this->weight; },
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

        return "62";

    }

}
