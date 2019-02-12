<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Hour extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'opening_time' => [
                'doc' => 'The opening time on this day of the week',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('opening_time'),
            ],
            'closing_time' => [
                'doc' => 'The closing time on this day of the week',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('closing_time'),
            ],
            // TODO: add documentation for `type` once we learn what it represents
            'type' => [
                'doc' => '(Not sure what this field is for)',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'day_of_week' => [
                'doc' => 'Number indicating the day of the week',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            // TODO: Rename to `is_closed`
            'closed' => [
                'doc' => 'Whether the museum is closed during these hours',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
        ];
    }

}
