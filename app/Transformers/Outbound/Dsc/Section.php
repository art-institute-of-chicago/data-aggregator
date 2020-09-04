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
            'revision' => [
                'doc' => 'Version identifier as provided by Drupal',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'source_id' => [
                'doc' => 'Drupal node id, unique only within the site of this publication',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'weight' => [
                'doc' => 'Number representing this section\'s sort order',
                'type' => 'number',
                'elasticsearch' => 'integer',
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
                    return $item->artwork->citi_id ?? null;
                },
            ],

            // TODO: Refactor relationships:
            'parent_id' => [
                'doc' => 'Uniquer identifier of the parent section',
                'type' => 'number',
                'elasticsearch' => 'long',
                'value' => function ($item) {
                    return $item->parent->dsc_id ?? null;
                },
            ],
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
                    return $item->publication->dsc_id ?? null;
                },
            ],

            // Normally, we output relationships last
            // Putting content last here, since it tends to be long
            'content' => [
                'doc' => 'Content of this section in plaintext',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                    'type' => 'text',
                ],
            ],
        ];
    }
}
