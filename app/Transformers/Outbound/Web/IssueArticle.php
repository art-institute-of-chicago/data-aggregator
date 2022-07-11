<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class IssueArticle extends BaseTransformer
{
    protected function getFields()
    {
        return [
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
            'issue_id' => [
                'doc' => 'Unique identifier of the issue this article belongs to',
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
