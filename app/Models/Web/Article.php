<?php

namespace App\Models\Web;

use App\Models\WebModel;
use App\Models\Documentable;
use App\Models\ElasticSearchable;

/**
 * Article on the website
 */
class Article extends WebModel
{

    protected $casts = [
        'source_created_at' => 'date',
        'source_modified_at' => 'date',
        'published' => 'boolean',
        'date' => 'date',
    ];

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'date',
                "doc" => "The date the article was published",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->date ? $this->date->toIso8601String() : NULL; },
            ],
            [
                "name" => 'copy',
                "doc" => "The text of the article",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->copy; },
            ],
        ];

    }

    public function getExtraFillFieldsFrom($source)
    {

        $ret = [
            'title' => $source->slug,
        ];

        // Ensure blocks are sorted by their position
        $blocks = array_sort($source->copy, function ($block) {
            return $block->position;
        });

        // Collect all the text in one block
        $text = "";
        foreach ($blocks as $block)
        {

            if ($block->type == 'paragraph')
            {

                $text .= $block->content->paragraph ?? '';

            }

        }
        $ret['copy'] = $text;

        // Get a URL to the first large image
        foreach ($blocks as $block)
        {

            if ($block->type == 'image')
            {

                $ret['imgix_uuid'] = $block->medias[0]->uuid;
                break;

            }
        }

        return $ret;

    }

}
