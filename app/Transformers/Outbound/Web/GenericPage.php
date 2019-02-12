<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\Web\Page as BaseTransformer;

class GenericPage extends BaseTransformer
{

    protected function getPageFields()
    {
        return [
            // TODO: Add `HasSearchTags` trait? See Event.
            'search_tags' => [
                'doc' => 'Editor-specified list of tags to aid in internal search',
                'type' => 'array',
                'elasticsearch' => [
                    'default' => true,
                    'type' => 'text',
                ],
                'value' => function ($item) {
                    if (!$item->search_tags) {
                        return null;
                    }

                    return collect(explode(',', $item->search_tags))->map(function ($item) {
                        return trim($item);
                    });
                },
            ],
        ];
    }

}
