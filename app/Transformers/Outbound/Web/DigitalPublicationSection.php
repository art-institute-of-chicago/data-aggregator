<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class DigitalPublicationSection extends BaseTransformer
{
    protected function getFields()
    {
        return [
            'web_url' => [
                'doc' => 'The URL to this section on our website',
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
