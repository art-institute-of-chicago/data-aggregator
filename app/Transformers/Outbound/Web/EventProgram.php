<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class EventProgram extends BaseTransformer
{
    protected function getFields()
    {
        return [
            'is_affiliate_group' => [
                'doc' => 'Whether this program represents an affiliate group',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'is_event_host' => [
                'doc' => 'Whether this program represents an event host',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
        ];
    }
}
