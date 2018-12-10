<?php

namespace App\Models\Web;

use App\Models\WebModel;

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
        ];

    }

}
