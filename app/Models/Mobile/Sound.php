<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;
use App\Models\Documentable;

/**
 * The audio file for a stops on a tour.
 */
class Sound extends MobileModel
{

    use Documentable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mobile_sounds';

    public function artworks()
    {

        return $this->belongsToMany('App\Models\Mobile\Artwork', 'mobile_artwork_mobile_sound', 'mobile_sound_mobile_id', 'mobile_artwork_mobile_id');

    }

    public function stops()
    {

        return $this->hasMany('App\Models\Mobile\TourStop', 'mobile_sound_mobile_id');

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'link',
                "doc" => "URL to the audio file",
                "type" => "url",
                "elasticsearch_type" => "keyword",
                "value" => function() { return $this->link; },
            ],
            [
                "name" => 'transcript',
                "doc" => "Text transcription of the audio file",
                "type" => "string",
                "elasticsearch" => [
                    "default" => true,
                    "type" => 'text',
                ],
                "value" => function() { return $this->transcript; },
            ],
        ];

    }

}
