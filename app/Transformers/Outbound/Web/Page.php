<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Page extends BaseTransformer
{
    protected function getFields()
    {
        $sharedFields = [
            'web_url' => [
                'doc' => 'The URL to this page on our website',
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
