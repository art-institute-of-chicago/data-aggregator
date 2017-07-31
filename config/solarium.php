<?php

return [
    'endpoint' => [
        'default' => [
            'host' => env('SOLR_HOST', '127.0.0.1'),
            'port' => env('SOLR_PORT', '8983'),
            'path' => env('SOLR_PATH', '/solr/'),
            'core' => env('SOLR_CORE', 'collection1'),
            'timeout' => 500,
        ]
    ],
];