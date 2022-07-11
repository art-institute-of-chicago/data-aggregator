<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\Web\Traits\HasPublishDates;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Experience extends BaseTransformer
{

    use HasPublishDates;

    protected function getFields()
    {
        return [
            'sub_title' => [
                'doc' => 'Sub title of the experience',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->sub_title;
                },
            ],
            'description' => [
                'doc' => 'Description of the experience',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->description;
                },
            ],
            'position' => [
                'doc' => 'Sort order of the experience',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->position;
                },
            ],
            'interactive_feature_id' => [
                'doc' => 'Unique identifer of interactive feature this experience is a part of',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->interactive_feature_id;
                },
            ],
            'is_published' => [
                'doc' => 'Whether the experience has been published',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'is_restricted' => true,
            ],
            'is_archived' => [
                'doc' => 'Whether the experience has been archived',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'value' => function ($item) {
                    return $item->archived;
                },
                'is_restricted' => true,
            ],
            'is_kiosk_only' => [
                'doc' => 'Whether the experience is only available as an in-gallery kiosk',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'value' => function ($item) {
                    return $item->kiosk_only;
                },
            ],
        ];
    }
}
