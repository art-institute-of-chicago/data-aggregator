<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

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
     * Turn this model object into a generic array.
     *
     * @param boolean  $withTitles
     * @return array
     */
    public function transformFields()
    {

        return [
            'image' => $this->image,
            'description' => $this->description,
            'intro' => $this->intro_text,
            'weight' => $this->weight,
            'intro_link' => $this->intro->link,
            'intro_transcript' => $this->intro->transcript,
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
