<?php

namespace App\Transformers\Outbound;

use Illuminate\Database\Eloquent\Model;

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
        return array_map(function ($mappedField) use ($model) {
            return call_user_func($mappedField['value'], $model);
        }, $this->getMappedFields());
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
            $this->getTitles(),
            $this->getFields(),
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
                'doc' => 'Date and time the record was updated in the aggregator',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('updated_at'),
            ],
        ];
    }

    protected function getDateValue($fieldName)
    {
        return function ($item) use ($fieldName) {
            return $item->$fieldName ? $item->$fieldName->toIso8601String() : null;
        };
    }

}
