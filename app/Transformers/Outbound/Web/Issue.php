<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Issue extends BaseTransformer
{
    protected function getFields()
    {
        return [
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
