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
            [
                "name" => 'title',
                "doc" => "Name of this tour stop",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->sound->title ?? null; },
            ],
            [
                "name" => 'artwork_title',
                "doc" => "Name of the artwork for this tour stop",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->artwork->title ?? null; },
            ],
            [
                "name" => 'artwork_id',
                "doc" => "Unique identifier of the artwork for this tour stop",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->artwork->artwork->citi_id ?? null; },
            ],
            [
                "name" => 'tour_id',
                "doc" => "Unique identifier of the tour this stop is a part of",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->tour->mobile_id ?? null; },
            ],
            [
                "name" => 'mobile_sound',
                "doc" => "URL to the audio file for this tour stop",
                "type" => "url",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->sound->link ?? null; },
            ],
            [
                "name" => 'mobile_sound_id',
                "doc" => "Unique identifier of the audio file for this tour stop",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->sound->mobile_id ?? null; },
            ],
            [
                "name" => 'weight',
                "doc" => "Number representing this tour stop's sort order",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->weight; },
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

        return "1041";

    }

}
