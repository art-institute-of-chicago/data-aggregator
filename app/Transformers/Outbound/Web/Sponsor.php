<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\Web\Traits\HasPublishDates;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Sponsor extends BaseTransformer
{

    use HasPublishDates;

    protected function getFields()
    {
        return [
            // TODO: Rename to `is_published` and move to HasPublishDates?
            'published' => [
                'doc' => 'Whether the sponsor is published on the website',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],

            'content' => [
                'doc' => 'The HTML used to render this sponsor in the frontend',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
        ];
    }

}
