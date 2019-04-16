<?php

namespace App\Transformers\Outbound\Web\Traits;

trait HasSearchTags
{

    protected function getFieldsForHasSearchTags()
    {
        return [
            'search_tags' => [
                'doc' => 'Editor-specified list of tags to aid in internal search',
                'type' => 'array',
                'elasticsearch' => [
                    'default' => true,
                    'boost' => 5,
                    'type' => 'text',
                ],
                'value' => function ($item) {
                    if (!$item->search_tags) {
                        return null;
                    }

                    return collect(explode(',', $item->search_tags))->map(function ($item) {
                        return trim($item);
                    })->filter();
                },
            ],
        ];
    }
}
