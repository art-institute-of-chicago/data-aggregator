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
     * Get an image to represent this record
     *
     * @return string
     */
    public function searchableImage()
    {

        return null;

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
                'image_url' => $this->searchableImage(),
                'title' => $this->title,
                'timestamp' => Carbon::now()->toIso8601String(),
            ],
            $this->getSuggestSearchFields(),
            $this->transform($withTitles = true)
        );

        return $array;

    }

    /**
     * Add suggest fields and values. By default, only boosted works are added to the autocomplete.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/5.3/search-suggesters.html
     * @link https://www.elastic.co/blog/you-complete-me
     *
     * @return array
     */
    public function getSuggestSearchFields()
    {

        // This happens when the title is empty (e.g. TourStops)
        // Fixes: completion field [suggest_autocomplete] does not support null values
        if( empty( $this->title ) )
        {
            return [];
        }

        // TODO: Move `suggest_autocomplete_boosted` into `suggest_autocomplete`, and re-index everything from database?
        $fields = [
            'suggest_autocomplete' => $this->title,
        ];

        if( $this->isBoosted() )
        {
            $fields['suggest_autocomplete_boosted'] = $this->title;
        }

        return $fields;

    }


    /**
     * Return mapping of fields marked as default, for simple search.
     *
     * @return array
     */
    public function getDefaultSearchFieldMapping()
    {

        $fields = array_merge($this->transformMappingInternal(), $this->transformTitles());

        $fields = array_filter( $fields, function($field) {

            return isset( $field['elasticsearch'] )
                && isset( $field['elasticsearch']['default'] )
                && $field['elasticsearch']['default'] == true;

        });

        return $fields;

    }

    /**
     * Return names of fields marked as default, for simple search.
     * This method appends a boost factor to the field name, if present.
     *
     * ```php
     * [
     *     'name' => 'foobar',
     *     'elasticsearch' => [
     *         'default' => true,
     *         'boost' => 3,
     *         'type' => 'text',
     *     ]
     * ],
     * ```
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/5.3/query-dsl-multi-match-query.html
     *
     * @return array
     */
    public function getDefaultSearchFields()
    {

        $fields = $this->getDefaultSearchFieldMapping();

        $fields = array_map( function( $field ) {

            $label = $field['name'];

            if( isset( $field['elasticsearch']['boost'] ) )
            {
                $label .= '^' . $field['elasticsearch']['boost'];
            }

            return $label;

        }, $fields);

        return $fields;

    }

    /**
     * Generate an array representing the schema for this object.
     *
     * @return array
     */
    public function elasticsearchMapping()
    {

        // Get a default list of field names for this model
        $fieldMappings = array_merge($this->transformMappingInternal(), $this->transformTitles());

        $default = [];

        foreach( $fieldMappings as $field )
        {

            $mapping = $this->getMappingForField( $field );

            // TODO: Determine if we can just pass null here
            if( $mapping )
            {
                $default[ $field['name'] ] = $mapping;
            }

        }

        // Now bring it all together
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
                            // TODO: Remove this after we regenerate all search indexes?
                            'suggest_autocomplete_boosted' => [
                                'type' => 'completion',
                                'analyzer' => 'article', // Custom: targets only `a`, `an`, `the`
                                'preserve_position_increments' => false, // Strips leading whitespace, leftover from articles
                            ],
                        ],
                        $default,
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

    /**
     * Retrieve Elasticsearch mappings for a single field.
     *
     * With this method, all of the following field definitions are valid:
     *
     * ```php
     * [
     *     [
     *         'name' => 'foo',
     *         'elasticsearch_type' => 'integer',
     *     ],
     *     [
     *         'name' => 'bar',
     *         'elasticsearch' => 'integer',
     *     ],
     *     [
     *         'name' => 'baz',
     *         'elasticsearch' => [
     *             'default' => true,      // app-specific setting
     *             'type' => 'integer',
     *         ]
     *     ],
     *     [
     *         'name' => 'bom',
     *         'elasticsearch' => [
     *             'default' => true,      // app-specific setting
     *             'mapping' => [
     *                 'type' => 'integer',
     *             ]
     *         ]
     *     ],
     * ]
     * ```
     *
     * This allows us to add mapping params that aren't `type` and to mix Elasticsearch
     * mappings with app-specific params, such as whether a term should be targeted for
     * simple searches on this model.
     *
     * Returns `null` if the mapping could not be parsed.
     *
     * @link http://nocf-www.elastic.co/guide/en/elasticsearch/reference/5.3/mapping-params.html
     *
     *
     * @return array
     */
    private function getMappingForField( $field )
    {

        if( $field['elasticsearch'] ?? false )
        {

            // Allows setting params other than type
            if( $field['elasticsearch']['mapping'] ?? false )
            {

                return $field['elasticsearch']['mapping'];

            }

            // Allows using 'elasticsearch' like 'elasticsearch_type'
            if( is_string( $field['elasticsearch'] ) )
            {

                return [
                    'type' => $field['elasticsearch'],
                ];

            }

            // Allows setting app-specific parameters alongside
            if( $field['elasticsearch']['type'] ?? false )
            {

                return [
                    'type' => $field['elasticsearch']['type'],
                ];

            }

        } else {

            // Supporting old behavior
            if( $field['elasticsearch_type'] ?? false )
            {

                return [
                    'type' => $field['elasticsearch_type'],
                ];

            }

        }

        return null;

    }

}
