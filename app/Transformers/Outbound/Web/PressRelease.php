<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class PressRelease extends BaseTransformer
{
    protected function getFields()
    {
        $sharedFields = [
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

            // TODO: This also seems to always be null. Audit?
            'image_url' => [
                'doc' => 'The URL of an image representing this page',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],

            'copy' => [
                'doc' => 'The text of the page',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
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
