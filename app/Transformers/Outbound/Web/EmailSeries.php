<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class EmailSeries extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'use_short_description' => [
                'doc' => 'Whether to use the event\'s `short_description` as default copy',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'show_affiliate' => [
                'doc' => 'Whether to show the "Send to Affiliate Members" option',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'show_member' => [
                'doc' => 'Whether to show the "Send to Members" option',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'show_sustaining_fellow' => [
                'doc' => 'Whether to show the "Send to Sustaining Fellows" option',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'show_nonmember' => [
                'doc' => 'Whether to show the "Send to Non-Members" option',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
        ];
    }

}
