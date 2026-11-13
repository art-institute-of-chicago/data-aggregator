<?php

namespace App\Transformers\Outbound;

/**
 * Serializes entries from the change log for the `/changes` endpoint.
 * Not a searchable resource, so the standard title, date, and search fields are omitted.
 */
class RecordChange extends AbstractTransformer
{
    protected function getIds()
    {
        return [
            'id' => [
                'doc' => 'Unique identifier of this change log entry',
                'type' => 'number',
                'value' => fn ($item) => $item->id,
            ],
        ];
    }

    protected function getFields()
    {
        return [
            'resource' => [
                'doc' => 'Endpoint of the record that changed, e.g. `artworks`',
                'type' => 'string',
                'value' => fn ($item) => $item->resource,
            ],
            'record_id' => [
                'doc' => 'Identifier of the record that changed',
                'type' => 'string',
                'value' => fn ($item) => $item->record_id,
            ],
            'event' => [
                'doc' => 'One of `created`, `updated`, or `deleted`',
                'type' => 'string',
                'value' => fn ($item) => $item->event,
            ],
            'field' => [
                'doc' => 'Name of the API field that changed. Null for `created` and `deleted` events.',
                'type' => 'string',
                'value' => fn ($item) => $item->field,
            ],
            'old_value' => [
                'doc' => 'Value of the field before the change',
                'type' => 'mixed',
                'value' => fn ($item) => $item->old_value,
            ],
            'new_value' => [
                'doc' => 'Value of the field after the change',
                'type' => 'mixed',
                'value' => fn ($item) => $item->new_value,
            ],
            'detected_at' => [
                'doc' => 'Date and time the change was detected. Changes detected together share this value.',
                'type' => 'ISO 8601 date and time',
                'value' => $this->getDateValue('detected_at'),
            ],
        ];
    }

    protected function getTitles()
    {
        return [];
    }

    protected function getSearchFields()
    {
        return [];
    }

    protected function getSuggestFields()
    {
        return [];
    }

    protected function getDates()
    {
        return [];
    }
}
