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
            'creator' => [
                'doc' => 'Creator/author of the archival material',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                ],
            ],
            'date_display' => [
                'doc' => 'Human-readable creation date',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'date_start' => [
                'doc' => 'Earliest year for date range queries',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'date_end' => [
                'doc' => 'Latest year for date range queries',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'format' => [
                'doc' => 'Genre/form of the archival material (letters, photographs, etc.)',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'collection_type' => [
                'doc' => 'Collection type: archives or library',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'record_type' => [
                'doc' => 'Record type within the collection (book, exhibition_catalog, artist_files, etc.)',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'has_media' => [
                'doc' => 'Whether the archive has associated media files',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'subjects' => [
                'doc' => 'Subject headings for this archive',
                'type' => 'array',
                'elasticsearch' => 'keyword',
            ],
            'language' => [
                'doc' => 'Language code of the material',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'description' => [
                'doc' => 'Physical description or summary of the material',
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
