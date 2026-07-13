<?php

namespace App\Transformers\Outbound\Archive;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Archive extends BaseTransformer
{
    protected function getFields()
    {
        return [
            'title' => [
                'doc' => 'Title of the archival material',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                ],
            ],
            'lccn' => [
                'doc' => 'LCCN identifiers for this archive',
                'type' => 'array',
                'elasticsearch' => 'keyword',
            ],
            'mms_id' => [
                'doc' => 'Alma MMS ID',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'contentdm_collection' => [
                'doc' => 'ContentDM collection alias',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'contentdm_id' => [
                'doc' => 'ContentDM item ID',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'contentdm_url' => [
                'doc' => 'URL to the ContentDM download',
                'type' => 'url',
                'elasticsearch' => 'keyword',
            ],
            'web_url' => [
                'doc' => 'Public-facing URL for this archive',
                'type' => 'url',
                'elasticsearch' => 'keyword',
            ],
            'match_type' => [
                'doc' => 'How this archive was matched (lccn or name)',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'match_confidence' => [
                'doc' => 'Confidence of the match (positive or tentative)',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'metadata' => [
                'doc' => 'Full metadata blob from source APIs',
                'type' => 'object',
            ],
            'agent_ids' => [
                'doc' => 'Unique identifiers of the agents this archive is associated with',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->agents->pluck('id');
                },
            ],
            'agent_titles' => [
                'doc' => 'Names of the agents this archive is associated with',
                'type' => 'array',
                'elasticsearch' => [
                    'default' => true,
                ],
                'value' => function ($item) {
                    return $item->agents->pluck('title');
                },
            ],
        ];
    }
}
