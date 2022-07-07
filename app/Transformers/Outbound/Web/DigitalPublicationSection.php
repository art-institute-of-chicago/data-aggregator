<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\Web\Traits\HasPublishDates;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class DigitalPublicationSection extends BaseTransformer
{

    use HasPublishDates;

    protected function getFields()
    {
        return [
            'is_published' => [
                'doc' => 'Whether the section has been published',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'is_restricted' => true,
            ],

            'web_url' => [
                'doc' => 'The URL to this section on our website',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'slug' => [
                'doc' => 'A human-readable string used in the URL',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],

            'listing_description' => [
                'doc' => 'A brief description of the section used in listings',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'copy' => [
                'doc' => 'The text of the section',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                ],
            ],
            // TODO: This seems to always be null. Remove?
            'type' => [
                'doc' => 'The type of section this record represents',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'heading' => [
                'doc' => 'A brief description of the section used at the top of the page',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'date' => [
                'doc' => 'The date the section was published',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('date'),
            ],
            'author_display' => [
                'doc' => 'A display-friendly text of the authors of this section',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'digital_publication_id' => [
                'doc' => 'Unique identifier of the digital publication this section belongs to',
                'type' => 'number',
                'elasticsearch' => 'integer',
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
