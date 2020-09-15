<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\Web\Traits\HasPublishDates;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Page extends BaseTransformer
{

    use HasPublishDates;

    protected function getFields()
    {
        $sharedFields = [
            // TODO: Ensure consistent naming and move to HasPublishDates
            'is_published' => [
                'doc' => 'Whether the page has been published',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'value' => function ($item) {
                    return $item->published;
                },
                'is_restricted' => true,
            ],

            // TODO: This seems to always be null. Remove?
            'type' => [
                'doc' => 'The type of page this record represents',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],

            'web_url' => [
                'doc' => 'The URL to this page on our website',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'slug' => [
                'doc' => 'A human-readable string used in the URL',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],

            // TODO: This also seems to always be null. Audit?
            'image_url' => [
                'doc' => 'The URL of an image representing this page',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],

            // TODO: Give option to put long fields last?
            // TODO: Combine `listing_description` and `short_description`?
            'listing_description' => [
                'doc' => 'A brief description of the page used in listings',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'short_description' => [
                'doc' => 'A brief description of the page used in mobile and meta tags',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'copy' => [
                'doc' => 'The text of the page',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                    'type' => 'text',
                ],
            ],
        ];

        return array_merge(
            $sharedFields,
            $this->getPageFields()
        );
    }

    /**
     * Provide a way for child classes to add fields to the transformation.
     *
     * @return array
     */
    protected function getPageFields()
    {
        return [];
    }
}
