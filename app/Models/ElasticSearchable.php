<?php

namespace App\Models;

use Laravel\Scout\Searchable;

use Carbon\Carbon;

trait ElasticSearchable
{

    use Searchable;

    protected $apiCtrl;


    /**
     * Get the type associated with this model. We need to overwrite the inherited method
     * because it defaults to using the table name. We need to use the model name instead.
     * This method is used when a document gets indexed, not when the mappings are defined.
     * This avoids a number of bugs, including `tour_stops` vs. `tour-stops`, `agents` vs.
     * `artists`, and `assets` vs. `images`.
     *
     * @return string
     */
    public function searchableAs()
    {

        return config('scout.prefix') . $this->searchableModel();

    }


    /**
     * Generate a link to the API for this model resource.
     *
     * @return string
     */
    protected function searchableLink()
    {

        $calledClass = get_called_class();

        $this->apiCtrl = $this->apiCtrl ?: str_plural( class_basename($calledClass) ) . 'Controller';

        return action($this->apiCtrl . '@show', ['id' => $this->getKey()]);

    }


    /**
     * Generate a string to use in the seach index to identify this model
     *
     * @return string
     */
    protected function searchableModel()
    {

        $calledClass = get_called_class();

        return str_plural(kebab_case(class_basename($calledClass)));

    }


    /**
     * Generate a string identifying this model's data source.
     *
     * @return string
     */
    protected function searchableSource()
    {

        $calledClass = get_called_class();

        return kebab_case( array_slice( explode('\\', $calledClass), -2, 1)[0] );

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
                'timestamp' => Carbon::now()->toIso8601String(),
                'suggest_autocomplete' => [$this->title],
                'suggest_phrase' => $this->title,
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
                $this->searchableAs() => [
                    'properties' => array_merge(
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
                            'timestamp' => [
                                'type' => 'date',
                            ],
                            'suggest_autocomplete' => [
                                'type' => 'completion',
                            ],
                            'suggest_phrase' => [
                                'type' => 'keyword',
                                'fields' => [
                                    'trigram' => [
                                        'type' => 'text',
                                        'analyzer' => 'trigram'
                                    ],
                                    'reverse' => [
                                        'type' => 'text',
                                        'analyzer' => 'reverse'
                                    ],
                                ],
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

        $fieldMappings = array_merge($this->transformMappingInternal(), $this->transformTitles());

        $ret = [];
        foreach (array_pluck($fieldMappings, 'elasticsearch_type', 'name') as $field => $type)
        {

            if ($type)
            {

                $ret[$field] = [
                    'type' => $type
                ];

            }

        }

        return $ret;

    }

}
