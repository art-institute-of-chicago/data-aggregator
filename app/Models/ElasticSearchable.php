<?php

namespace App\Models;

use Laravel\Scout\Searchable;

use Illuminate\Support\Str;

trait ElasticSearchable
{

    use Searchable;

    /**
     * We need to overwrite the inherited method because it defaults to using the table name.
     * We need to differentiate between "index" and "type" for legacy reasons.
     */
    public function searchableAs()
    {
        throw new \Exception('ElasticSearchable does not support `searchableAs`. Use `searchableType` or `searchableIndex` instead.');
    }

    /**
     * We used to use resource names for types, but have since changed to using `doc` everywhere.
     *
     * In this trait, we specify that this method should be called to define the mapping.
     *
     * `\ScoutEngines\Elasticsearch\ElasticsearchEngine` uses it when indexing docs.
     *
     * @TODO Change this to `_doc` when we upgrade to ES 6.2?
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/removal-of-types.html
     * @link https://discuss.elastic.co/t/cant-use-doc-as-type-despite-it-being-declared-the-preferred-method/113837
     *
     * @return string
     */
    public function searchableType()
    {
        return 'doc';
    }

    /**
     * Similar idea to `searchableType`, except this one is always the resource name.
     *
     * `\ScoutEngines\Elasticsearch\ElasticsearchEngine` uses it when indexing docs.
     *
     * Passing `true` as the second argument when instantiating the engine makes it treat
     * the string in its first argument as a prefix to be prepended to this string
     *
     * @return string
     */
    public function searchableIndex()
    {
        return app('Resources')->getEndpointForModel(get_called_class());
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

        return $this->transform();

    }

    /**
     * Return mapping of fields marked as default, for simple search.
     *
     * @return array
     */
    public function getDefaultSearchFieldMapping($isExact)
    {

        $fields = $this->transformMapping();

        $fields = array_filter($fields, function ($field) use ($isExact) {

            return isset($field['elasticsearch'])
                && isset($field['elasticsearch']['default'])
                && $field['elasticsearch']['default'] === true
                && (!$isExact || $field['elasticsearch']['default'] !== 'except_exact');

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
    public function getDefaultSearchFields($isExact)
    {
        $fields = $this->getDefaultSearchFieldMapping($isExact);

        $fields = array_map(function ($field) {

            $label = $field['name'];

            if (isset($field['elasticsearch']['boost']))
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
        $fieldMappings = $this->transformMapping();

        $default = [];

        foreach ($fieldMappings as $field)
        {
            $mapping = $this->getMappingForField($field);

            // TODO: Determine if we can just pass null here
            if ($mapping)
            {
                $default[$field['name']] = $mapping;
            }
        }

        // Now bring it all together
        return [
            $this->searchableType() => [
                'properties' => $default,
            ],
        ];
    }

    /**
     * Generate a string identifying this model's data source.
     *
     * @return string
     */
    protected function searchableSource()
    {

        $calledClass = get_called_class();

        return Str::kebab(array_slice(explode('\\', $calledClass), -2, 1)[0]);

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
    private function getMappingForField($field)
    {

        if ($field['elasticsearch'] ?? false)
        {

            // Allows setting params other than type
            if ($field['elasticsearch']['mapping'] ?? false)
            {

                return $field['elasticsearch']['mapping'];

            }

            // Allows using 'elasticsearch' like 'elasticsearch_type'
            if (is_string($field['elasticsearch']))
            {

                return [
                    'type' => $field['elasticsearch'],
                ];

            }

            // Allows setting app-specific parameters alongside
            if ($field['elasticsearch']['type'] ?? false)
            {

                return [
                    'type' => $field['elasticsearch']['type'],
                ];

            }

        } else {

            // Supporting old behavior
            if ($field['elasticsearch_type'] ?? false)
            {

                return [
                    'type' => $field['elasticsearch_type'],
                ];

            }

        }

        return null;

    }

}
