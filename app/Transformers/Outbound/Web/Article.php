<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Article extends BaseTransformer
{
    protected function getFields()
    {
        return [
            'is_published' => [
                'doc' => 'Whether the article has been published',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'is_restricted' => true,
            ],
            // TODO: Is this different from the CMS publish date?
            'date' => [
                'doc' => 'The date the article was published',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('date'),
            ],
            'copy' => [
                'doc' => 'The text of the article',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                ],
            ],
        ];
    }
}
