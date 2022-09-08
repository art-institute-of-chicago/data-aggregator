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
            'copy' => [
                'doc' => 'The text of the section',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                ],
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
