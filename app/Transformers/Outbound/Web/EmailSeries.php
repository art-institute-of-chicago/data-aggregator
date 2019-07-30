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
            'show_affiliate_member' => [
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
            'show_non_member' => [
                'doc' => 'Whether to show the "Send to Non-Members" option',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'affiliate_member_copy' => [
                'doc' => 'Default copy for Affiliate Members',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'member_copy' => [
                'doc' => 'Default copy for Members',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'sustaining_fellow_copy' => [
                'doc' => 'Default copy for Sustaining Fellows',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'non_member_copy' => [
                'doc' => 'Default copy for Non-Members',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
        ];
    }

}
