<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Artist extends BaseTransformer
{
    protected function getTitles()
    {
        return array_replace_recursive(parent::getTitles(), [
            'title' => [
                'value' => function ($item) {
                    return $item->agent->title ?? null;
                },
            ],
        ]);
    }

    protected function getFields()
    {
        return [
            'agent_id' => [
                'doc' => 'Unique identifier of the CITI agent record this artist represents',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    // API-91: Specify `with` on this field; be careful about infinite loops
                    return $item->agent->id ?? null;
                },
            ],
            'intro_copy' => [
                'doc' => 'Description of the artist',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
        ];
    }
}
