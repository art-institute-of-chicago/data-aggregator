<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\Web\Traits\HasPublishDates;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class InteractiveFeature extends BaseTransformer
{

    use HasPublishDates;

    protected function getFields()
    {
        return [
            'sub_title' => [
                'doc' => 'Sub title of the interactive feature',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->sub_title;
                },
            ],
            'grouping_background_color' => [
                'doc' => 'The background color of experiences in this interactive feature',
                'type' => 'string',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->grouping_background_color;
                },
            ],
            'color' => [
                'doc' => 'The main color of this interactive feature',
                'type' => 'string',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->color;
                },
            ],
            'is_published' => [
                'doc' => 'Whether the interactive feature has been published',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'is_restricted' => true,
            ],
            'is_archived' => [
                'doc' => 'Whether the interactive feature has been archived',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'value' => function ($item) {
                    return $item->archived;
                },
                'is_restricted' => true,
            ],
        ];
    }
}
