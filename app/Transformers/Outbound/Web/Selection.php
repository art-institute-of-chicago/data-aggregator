<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\Web\Traits\HasPublishDates;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Selection extends BaseTransformer
{

    use HasPublishDates;

    protected function getFields()
    {
        return [
            // TODO: Rename to `is_published` and move to trait?
            'published' => [
                'doc' => 'Whether the location is published on the website',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'short_copy' => [
                'doc' => 'A brief summary of what is contained in the selection',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'copy' => [
                'doc' => 'The text of the selection description',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                    'type' => 'text',
                ],
            ],
        ];
    }

}
