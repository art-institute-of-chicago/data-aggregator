<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Artist extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'has_also_known_as' => [
                'doc' => 'Whether the artist will display multiple names',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'value' => function ($item) {
                    return $item->also_known_as;
                },
            ],
            'intro_copy' => [
                'doc' => 'Description of the artist',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'agent_id' => [
                'doc' => 'Unique identifier of the CITI agent records this artist represents',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->datahub_id;
                },
            ],
        ];
    }

}
