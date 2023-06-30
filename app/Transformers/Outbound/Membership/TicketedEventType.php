<?php

namespace App\Transformers\Outbound\Membership;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class TicketedEventType extends BaseTransformer
{
    protected function getFields()
    {
        return [
            'category' => [
                'doc' => 'The category of this event type',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'description' => [
                'doc' => 'Description of this event type',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
        ];
    }
}
