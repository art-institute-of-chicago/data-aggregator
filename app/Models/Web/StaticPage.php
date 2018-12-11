<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Pages defined in the website code.
 */
class StaticPage extends WebModel
{

    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'web_url',
                "doc" => "The URL to this page on our website",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->web_url; },
            ],
            [
                "name" => 'is_published',
                "doc" => "Whether this static page is available to view (always true)",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return true; },
            ],
        ];

    }

}
