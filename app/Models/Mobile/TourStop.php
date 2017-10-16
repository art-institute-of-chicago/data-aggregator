<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

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
            'artwork_id' => $this->artwork->artwork->id,
            'mobile_sound' => $this->sound->link,
            'mobile_sound_id' => $this->sound->id,
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
