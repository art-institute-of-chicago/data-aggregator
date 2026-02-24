<?php

return [

    /**
     * You can specify one of several different connections when building an
     * Elasticsearch client.
     *
     * Here you may specify which of the connections below you wish to use
     * as your default connection when building an client. Of course you may
     * use create several clients at once, each with different configurations.
     */

    'defaultConnection' => 'default',

    /**
     * These are the connection parameters used when building a client.
     */

    'connections' => [

        'default' => [

            /**
             * Hosts
             *
             * This is an array of hosts that the client will connect to. It can be a
             * single host, or an array if you are running a cluster of Elasticsearch
             * instances.
             *
             * This is the only configuration value that is mandatory.
             *
             * @see https://www.elastic.co/docs/reference/elasticsearch/clients/php/host-config
             */

            'hosts' => [
                env('ELASTICSEARCH_SCHEME', '')
                . (env('ELASTICSEARCH_SCHEME', null) ? '://' : '')
                . env('ELASTICSEARCH_HOST', 'localhost')
                . ':' . env('ELASTICSEARCH_PORT', 9200)
            ],

            'api_key' => env('ELASTICSEARCH_API_KEY', null),

            /**
             * Retries
             *
             * By default, the client will retry n times, where n = number of nodes in
             * your cluster. If you would like to disable retries, or change the number,
             * you can do so here.
             *
             * @see https://www.elastic.co/docs/reference/elasticsearch/clients/php/set-retries
             */

            'retries' => null,

            /**
             * Logging
             *
             * Logging is handled by passing in an instance of Monolog\Logger (which
             * coincidentally is what Laravel's default logger is).
             *
             * If logging is enabled, you either need to set the path and log level
             * (some defaults are given for you below), or you can use a custom logger by
             * setting 'logObject' to an instance of Psr\Log\LoggerInterface.  In fact,
             * if you just want to use the default Laravel logger, then set 'logObject'
             * to \Log::getMonolog().
             *
             * Note: 'logObject' takes precedent over 'logPath'/'logLevel', so set
             * 'logObject' null if you just want file-based logging to a custom path.
             *
             * @see https://www.elastic.co/docs/reference/elasticsearch/clients/php/enabling_logger
             */

            'logging' => true,

            // If you have an existing instance of Monolog you can use it here.
            // 'logObject' => \Log::getMonolog(),

            'logPath' => storage_path('logs/elasticsearch.log'),

            'logLevel' => Monolog\Logger::WARNING,

            /**
             * Retries
             *
             * By default, the client will retry n times, where n = number of nodes in
             * your cluster. If you would like to disable retries, or change the number,
             * you can do so here.
             *
             * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_set_retries
             */

            'retries' => null,
        ],

        'testing' => [

            'hosts' => [
                'localhost:9200'
            ],

            'retries' => null,

            'logging' => false,

            'logPath' => storage_path('logs/elasticsearch.log'),

            'logLevel' => Monolog\Logger::INFO,

            'retries' => null,
        ],

    ],

    'indexParams' => [
        'index' => env('ELASTICSEARCH_INDEX'),
        'body' => [
            'settings' => [
                'number_of_shards' => env('ELASTICSEARCH_SHARDS_PRIMARY', 1),
                'number_of_replicas' => env('ELASTICSEARCH_SHARDS_REPLICA', 0),
                'analysis' => [
                    'filter' => [
                        'english_stop' => [
                            'type' => 'stop',
                            'stopwords' => '_english_',
                        ],
                        'english_article_stop' => [
                            'type' => 'stop',
                            'ignore_case' => true,
                            'stopwords' => ['a', 'an', 'the'],
                        ],
                        /* This filter should be removed unless there are words which should be excluded from stemming.
                        'english_keywords' => [
                            'type' => 'keyword_marker',
                            'keywords' => ['example'],
                        ],
                        */
                        'english_stemmer' => [
                            'type' => 'stemmer',
                            'language' => 'english',
                        ],
                        'english_possessive_stemmer' => [
                            'type' => 'stemmer',
                            'language' => 'possessive_english',
                        ],
                        'shingle' => [
                            'type' => 'shingle',
                            'min_shingle_size' => 2, // default
                            'max_shingle_size' => 2, // default
                        ],
                    ],
                    'analyzer' => [
                        'default' => [
                            'tokenizer' => 'standard',
                            'filter' => [
                                'english_possessive_stemmer',
                                'lowercase',
                                'english_stop',
                                'english_stemmer',
                                'asciifolding',
                                'shingle',
                            ],
                        ],
                        'article' => [
                            'tokenizer' => 'standard',
                            'filter' => [
                                'lowercase',
                                'english_article_stop',
                                'asciifolding',
                            ],
                        ],
                        'exact' => [
                            'tokenizer' => 'standard',
                            'filter' => [
                                'lowercase',
                                'english_stop',
                                'asciifolding',
                                'shingle',
                            ],
                        ],
                    ],
                    'normalizer' => [
                        'lowercase_normalizer' => [
                            'type' => 'custom',
                            'filter' => [
                                'lowercase',
                                'asciifolding',
                            ],
                        ],
                    ],
                ],
            ],
            // Mappings are defined in SearchServiceProvider
            // https://laracasts.com/discuss/channels/laravel/how-to-access-auth-user-details-in-config-files
        ],

    ],
];
