<?php

namespace App\Transformers\Outbound;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use League\Fractal\TransformerAbstract as BaseTransformer;

abstract class AbstractTransformer extends BaseTransformer
{
    /**
     * Data type of the primary key field. Use Elasticsearch types
     * (keyword, integer, long) instead of PHP (string, integer).
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * Used for only returning a subset of fields.
     *
     * @link https://github.com/thephpleague/fractal/issues/226
     * @var string
     */
    private $requestedFields;

    /**
     * Caches the complete field mapping.
     *
     * @var array
     */
    private $mappedFields;

    /**
     * Be sure to call parent::__construct() if you overwrite this.
     * Otherwise, you will lose field-filtering functionality.
     */
    public function __construct($requestedFields = null)
    {
        $this->requestedFields = $this->getRequestedFields($requestedFields);
    }

    /**
     * Helper to parse out the fields variable passed via constructor.
     * Expects a comma-separated string or an array.
     *
     * @var array|null
     */
    private function getRequestedFields($requestedFields = null)
    {
        if (!isset($requestedFields)) {
            return null;
        }

        if (is_array($requestedFields)) {
            return $requestedFields;
        }

        if (is_string($requestedFields)) {
            return explode(',', $requestedFields);
        }

        return null;
    }

    /**
     * Consumers should call this. Let's never modify this method in child classes.
     *
     * @return array
     */
    public final function transform(Model $model)
    {
        $mappedFields = $this->getMappedFields();

        $filteredFields = array_filter($mappedFields, function ($mappedField) use ($model) {
            return !isset($mappedField['filter']) || call_user_func($mappedField['filter'], $model);
        });

        return array_map(function ($mappedField) use ($model) {
            return call_user_func($mappedField['value'], $model);
        }, $filteredFields);
    }

    /**
     * Getter to ensure that `$mappedFields` only gets defined once.
     *
     * @return array
     */
    public function getMappedFields()
    {
        return $this->mappedFields ?? $this->mappedFields = $this->initMappedFields();
    }

    private function initMappedFields()
    {
        $mappedFields = array_merge(
            $this->getIds(),
            $this->getSearchFields(),
            $this->getTitles(),
            $this->getFields(),
            $this->getSuggestFields(),
            $this->getDates()
        );

        if (isset($this->requestedFields))
        {
            $mappedFields = array_intersect_key($mappedFields, array_flip($this->requestedFields));
        }

        foreach ($mappedFields as $fieldName => $mappedField)
        {
            if (!isset($mappedFields[$fieldName]['value']))
            {
                $mappedFields[$fieldName]['value'] = function ($model) use ($fieldName) {
                    return $model->$fieldName;
                };
            }
        }

        return $mappedFields;
    }

    protected function getIds()
    {
        return [
            'id' => [
                'doc' => 'Unique identifier of this resource. Taken from the source system.',
                'type' => $this->keyType,
                'elasticsearch' => $this->keyType,
                'value' => function ($item) {
                    return $item->getAttributeValue($item->getKeyName());
                },
            ],
        ];
    }

    protected function getTitles()
    {
        return [
            'title' => [
                'doc' => 'Name of this resource',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                    'boost' => 1.5,
                ],
            ],
        ];
    }

    protected function getFields()
    {
        return [
            // Define in child classes
        ];
    }

    protected function getDates()
    {
        return [
            // TODO: Rename field to follow _at convention
            'last_updated_source' => [
                'doc' => 'Date and time the resource was updated in the source system',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('source_modified_at'),
            ],
            // TODO: Rename field to follow _at convention
            'last_updated' => [
                'doc' => 'Date and time the record was updated in the aggregator database',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('updated_at'),
            ],
            'timestamp' => [
                'doc' => 'Date and time the record was updated in the aggregator search index',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => function ($item) {
                    return Carbon::now()->toIso8601String();
                },
            ],
        ];
    }

    protected function getSearchFields()
    {
        return [
            'api_model' => [
                'doc' => 'REST API resource type or endpoint',
                'type' => 'string',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return app('Resources')->getEndpointForModel(get_class($item));
                },
            ],
            'api_link' => [
                'doc' => 'REST API link for this resource',
                'type' => 'string',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    $endpoint = app('Resources')->getEndpointForModel(get_class($item));
                    return url('api/v1/' . $endpoint . '/' . $item->getKey());
                },
            ],
        ];
    }

    /**
     * Add suggest fields and values. By default, nothing adds to autocomplete.
     *
     * However, due to a fluke in Elasticsearch, all resources should have these fields
     * defined in their index mapping. Otherwise, you may see this error:
     *
     *     no mapping found for field [suggest_autocomplete_boosted]
     *
     * Here, we add this field to all indexes, but make it so that the `filter` function
     * always returns `false` by default. No document will actually contain this field.
     *
     * If a resource needs these fields, look into the `HasSuggestFields` trait.
     * The trick is to override `filter` to return true as appropriate.
     *
     * Weirdly, we also cannot just set this field to `null`. Different error:
     *
     *     completion field [suggest_autocomplete_all] does not support null values
     *
     * Basically, this is the one case where we must omit fields, rather than nulling them.
     *
     * Uses custom `article` analyzer, which removes `a`, `an`, and `the`.
     * Uses `preserve_position_increments` to strip leftover leading whitespace.
     *
     * @return array
     */
    protected function getSuggestFields()
    {
        return [
            'suggest_autocomplete_boosted' => [
                'doc' => 'Internal field to power the `/autocomplete` endpoint. Do not use directly.',
                'type' => 'object',
                'elasticsearch' => [
                    'type' => 'completion',
                    'analyzer' => 'article',
                    'preserve_position_increments' => false,
                ],
                'filter' => function ($item) {
                    return false;
                },
                'value' => function ($item) {
                    return $item->title;
                },
            ],
            'suggest_autocomplete_all' => [
                'doc' => 'Internal field to power the `/autosuggest` endpoint. Do not use directly.',
                'type' => 'object',
                'elasticsearch' => [
                    'mapping' => [
                        'type' => 'completion',
                        'analyzer' => 'article',
                        'preserve_position_increments' => false,
                        'contexts' => [
                            [
                                // accession, title, boosted
                                'name' => 'groupings',
                                'type' => 'category',
                            ],
                        ],
                    ],
                ],
                'filter' => function ($item) {
                    return false;
                },
                'value' => function ($item) {
                    return [
                        'input' => [
                            $item->title
                        ],
                        'contexts' => [
                            'groupings' => [
                                'title',
                            ]
                        ],
                    ];
                },
            ],
        ];
    }

    protected function getDateValue($fieldName)
    {
        return function ($item) use ($fieldName) {
            return $item->$fieldName ? $item->$fieldName->toIso8601String() : null;
        };
    }

    protected function getEmptyValue($fieldName)
    {
        return function ($item) use ($fieldName) {
            return $item->$fieldName ?: null;
        };
    }

}
