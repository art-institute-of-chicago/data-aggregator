<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class DigitalPublicationArticle extends BaseTransformer
{
    protected function getFields()
    {
        return [
            'web_url' => [
                'doc' => 'The URL to this article on our website',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'copy' => [
                'doc' => 'The text of the article',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                ],
            ],
            'author_display' => [
                'doc' => 'A display-friendly text of the authors of this article',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'digital_publication_id' => [
                'doc' => 'Unique identifier of the digital publication this article belongs to',
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
