<?php

namespace App\Transformers\Outbound\Web\Traits;

trait HasPublishDates
{

    protected function getFieldsForHasPublishDates()
    {
        return [
            'publish_start_date' => [
                'doc' => 'The date a page was, or will be, published',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('publish_start_date'),
                'is_restricted' => true,
            ],
            'publish_end_date' => [
                'doc' => 'The date a page was, or will be, unpublished',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('publish_end_date'),
                'is_restricted' => true,
            ],
        ];
    }
}
