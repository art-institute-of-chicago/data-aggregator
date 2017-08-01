<?php

namespace App\Models;

use Laravel\Scout\Searchable;

trait ElasticSearchable
{

    use Searchable;

    protected $apiCtrl;

    public function __construct(array $attributes = array()) {

        parent::__construct($attributes);

        $this->apiCtrl = $this->apiCtrl ?: str_plural( class_basename(static::class) ) . 'Controller';

    }


    /**
     * Generate a link to the API for this model resource.
     *
     * @return string
     */
    protected function searchableLink()
    {

        return action($this->apiCtrl . '@show', ['id' => $this->getKey()]);

    }


    /**
     * Generate a string to use in the seach index to identify this model
     *
     * @return string
     */
    protected function searchableModel()
    {

        return kebab_case(class_basename(static::class));

    }


    /**
     * Generate a string identifying this model's data source.
     *
     * @return string
     */
    protected function searchableSource()
    {

        return kebab_case( array_slice( explode('\\', static::class), -2, 1)[0] );

    }


    /**
     * Generate a unique string identifying this model resource.
     *
     * @return string
     */
    public function searchableId()
    {

        return $this->searchableSource() . '.' .$this->searchableModel() . '.' . $this->getKey();

    }


    /**
     * Generate an array of model data to send to the search index.
     *
     * @return array
     */
    public function toSearchableArray()
    {

        $array = array_merge(
            [
                'id' => $this->searchableId(),
                'api_id' => "" .$this->getKey(),
                'api_model' => $this->searchableModel(),
                'api_link' => $this->searchableLink(),
                'title' => $this->title,
            ],
            $this->transform($withTitles = true)
        );

        return $array;

    }

    
    /**
     * Generate an array representing the schema for this object.
     *
     * @return array
     */
    public function elasticsearchMapping()
    {

        return
            [
                $this->searchableModel() => [
                    'properties' => 
                    array_merge(
                        [
                            'api_id' => [
                                'type' => 'keyword',
                            ],
                            'api_model' => [
                                'type' => 'keyword',
                            ],
                            'api_link' => [
                                'type' => 'keyword',
                            ],
                            'title' => [
                                'type' => 'text',
                            ],
                            'image' => [
                                'type' => 'keyword',
                            ],
                            'description' => [
                                'type' => 'text',
                            ],
                        ],
                        $this->elasticsearchMappingFields()
                    )
                ],
            ];

    }


    /**
     * Pluggable function to generate model-specific fields for an array representing the schema for this object.
     *
     * @return array
     */
    public function elasticsearchMappingFields()
    {

        return [];

    }

}
