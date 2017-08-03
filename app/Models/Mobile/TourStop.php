<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;
use App\Models\ElasticSearchable;

class TourStop extends MobileModel
{

    use ElasticSearchable;

    protected $primaryKey = 'id';

    public function tour()
    {

        return $this->belongsTo('App\Models\Mobile\Tour');

    }

    public function artwork()
    {

        return $this->belongsTo('App\Models\Collections\Artwork');

    }

    public function sound()
    {

        return $this->belongsTo('App\Models\Mobile\Sound');

    }


    /**
     * Turn this model object into a generic array.
     *
     * @param boolean  $withTitles
     * @return array
     */
    public function transformFields()
    {

        return [
            // TODO: Determine if tour stops have dedicated titles?
            'title' => $this->artwork->title,
            'artwork' => $this->artwork->title,
            'artwork_id' => $this->artwork_citi_id,
            'mobile_sound' => $this->sound->link,
            'mobile_sound_id' => $this->sound_mobile_id,
            'weight' => $this->weight,
            'description' => $this->description,
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

}
