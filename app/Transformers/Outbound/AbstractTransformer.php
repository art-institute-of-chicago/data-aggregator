<?php

namespace App\Transformers\Outbound;

use Illuminate\Database\Eloquent\Model;

use League\Fractal\TransformerAbstract as BaseTransformer;

abstract class AbstractTransformer extends BaseTransformer
{
    /**
     * TODO: Restore ?fields= functionality
     */
    private $requestedFields;

    private $mappedFields;

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
                'doc' => 'Date the source record was created',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
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
            'source_created_at' => [
                'doc' => 'Date the source record was created',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('source_created_at'),
            ],
            'source_modified_at' => [
                'doc' => 'Date the source record was modified',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('source_modified_at'),
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
