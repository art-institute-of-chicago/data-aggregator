<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Issue extends BaseTransformer
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
            'issue_number' => [
                'doc' => 'The number of the issue',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'cite_as' => [
                'doc' => 'How to cite the issue',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
        ];
    }
}
