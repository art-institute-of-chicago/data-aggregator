<?php

namespace App\Transformers\Outbound\Dsc;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Section extends BaseTransformer
{
    /**
     * Cantor pairs exceed integer limits.
     *
     * @var string
     */
    protected $keyType = 'long';

    protected function getFields()
    {
        return [
            'web_url' => [
                'doc' => 'URL to the section',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'accession' => [
                'doc' => 'An accession number parsed from the title or tombstone',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'generic_page_id' => [
                'doc' => 'Unique identifier of the page on the website that represents the publication this section belongs to',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->publication->generic_page_id ?? null;
                },
            ],
            'artwork_id' => [
                'doc' => 'Unique identifier of the artwork with which this section is associated',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->artwork->id ?? null;
                },
            ],

            // TODO: Refactor relationships:
            'publication_title' => [
                'doc' => 'Name of the publication this section belongs to',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->publication->title ?? null;
                },
            ],
            'publication_id' => [
                'doc' => 'Unique identifier of the publication this section belongs to',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->publication->id ?? null;
                },
            ],

            // Normally, we output relationships last
            // Putting content last here, since it tends to be long
            'content' => [
                'doc' => 'Content of this section in plaintext',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                ],
            ],
        ];
    }
}
