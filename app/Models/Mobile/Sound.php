<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;
use App\Models\Documentable;

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
     * Turn this item object into a generic array.
     *
     * @param  \App\Models\Mobile\Tour  $item
     * @return array
     */
    public function transformFields()
    {

        return [
            'link' => $this->link,
            'transcript' => $this->transcript,
        ];

    }

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "1545";

    }

    /**
     * Whether this resource has a `/search` endpoint
     *
     * @return boolean
     */
    public function hasSearchEndpoint()
    {

        return false;

    }

}
