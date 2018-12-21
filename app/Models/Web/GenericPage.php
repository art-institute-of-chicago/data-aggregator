<?php

namespace App\Models\Web;

/**
 * A generic page on the website
 */
class GenericPage extends Page
{

    protected $table = 'generic_pages';

    protected function transformMappingInternal()
    {

        return array_merge(parent::transformMappingInternal(), [
            [
                "name" => 'search_tags',
                "doc" => "Editor-specified list of tags to aid in internal search",
                "type" => "array",
                "elasticsearch" => [
                    "default" => true,
                    "type" => 'text',
                ],
                "value" => function() {
                    if (!$this->search_tags) {
                        return null;
                    }

                    return collect(explode(',', $this->search_tags))
                        ->map(function($item) {
                            return trim($item);
                        });
                },
            ],
        ]);

    }
}
