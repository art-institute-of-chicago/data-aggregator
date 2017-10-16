<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

class Gallery extends CollectionsModel
{

    use ElasticSearchable;
    use Documentable;

    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

    public function categories()
    {

        return $this->belongsToMany('App\Models\Collections\Category');

    }

    public function getFillFieldsFrom($source)
    {

        return [
            'closed' => $source->closed,
            'number' => $source->number,
            'floor' => $source->floor,
            'latitude' => $source->latitude,
            'longitude' => $source->longitude,
        ];

    }


    /**
     * Turn this model object into a generic array.
     *
     * @return array
     */
    public function transformFields()
    {

        return  [
            'is_closed' => (bool) $this->closed,
            'number' => $this->number,
            'floor' => $this->floor,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'latlon' => $this->latitude .',' .$this->longitude,
            'category_ids' => $this->categories->pluck('citi_id')->all(),
        ];

    }


    /**
     * Turn the titles for related models into a generic array
     *
     * @return array
     */
    protected function transformTitles()
    {

        return [

            'category_titles' => $this->categories->pluck('title')->all(),

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
                'is_closed' => [
                    'type' => 'boolean',
                ],
                'number' => [
                    'type' => 'keyword',
                ],
                'floor' => [
                    'type' => 'keyword',
                ],
                'latitude' => [
                    'type' => 'float',
                ],
                'longitude' => [
                    'type' => 'float',
                ],
                'latlon' => [
                    'type' => 'geo_point',
                ],
                'category_ids' => [
                    'type' => 'integer',
                ],
                'category_titles' => [
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

        return "400844"; //27946

    }

}
