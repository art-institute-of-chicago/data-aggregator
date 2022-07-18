<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Artist extends BaseTransformer
{
    // TODO: Remove title column + update inbound transformer?
    protected function getTitles()
    {
        $titleFields = parent::getTitles();

        $titleFields['title']['value'] = function ($item) {
            return $item->agent->title ?? 'N/A';
        };

        return $titleFields;
    }

    protected function getFields()
    {
        return [
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
                    return $item->agent->id ?? null;
                },
            ],
        ];
    }
}
