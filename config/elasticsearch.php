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
             * Presently using "extended" host configuration method
             *
             * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_extended_host_configuration
             *
             * There is also the shorter "inline" configuration method available
             *
             * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_inline_host_configuration
             */

            'hosts' => [
                [
                    'host' => env('ELASTICSEARCH_HOST', 'localhost'),
                    'port' => env('ELASTICSEARCH_PORT', 9200),
                    'scheme' => env('ELASTICSEARCH_SCHEME', null),
                    'user' => env('ELASTICSEARCH_USER', null),
                    'pass' => env('ELASTICSEARCH_PASS', null),
                ],
            ],

            /**
             * SSL
             *
             * If your Elasticsearch instance uses an out-dated or self-signed SSL
             * certificate, you will need to pass in the certificate bundle.  This can
             * either be the path to the certificate file (for self-signed certs), or a
             * package like https://github.com/Kdyby/CurlCaBundle.  See the documentation
             * below for all the details.
             *
             * If you are using SSL instances, and the certificates are up-to-date and
             * signed by a public certificate authority, then you can leave this null and
             * just use "https" in the host path(s) above and you should be fine.
             *
             * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_security.html#_ssl_encryption_2
             */

            'sslVerification' => null,

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
             * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#enabling_logger
             */

            'logging' => false,

            // If you have an existing instance of Monolog you can use it here.
            // 'logObject' => \Log::getMonolog(),

            'logPath' => storage_path('logs/elasticsearch.log'),

            'logLevel' => Monolog\Logger::INFO,

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

            /**
             * The remainder of the configuration options can almost always be left
             * as-is unless you have specific reasons to change them.  Refer to the
             * appropriate sections in the Elasticsearch documentation for what each option
             * does and what values it expects.
             */

            /**
             * Sniff On Start
             *
             * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html
             */

            'sniffOnStart' => false,

            /**
             * HTTP Handler
             *
             * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_configure_the_http_handler
             * @see http://ringphp.readthedocs.org/en/latest/client_handlers.html
             * @link https://github.com/jeskew/amazon-es-php
             */

            'httpHandler' => (
                Illuminate\Support\Str::endsWith(env('ELASTICSEARCH_HOST', ''), 'es.amazonaws.com') ? (
                    new Aws\ElasticsearchService\ElasticsearchPhpHandler(env('ELASTICSEARCH_AWS_REGION', 'us-east-1'))
                ) : null
            ),

            /**
             * Connection Pool
             *
             * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_setting_the_connection_pool
             * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_connection_pool.html
             */

            'connectionPool' => null,

            /**
             * Connection Selector
             *
             * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_setting_the_connection_selector
             * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_selectors.html
             */

            'connectionSelector' => null,

            /**
             * Serializer
             *
             * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_setting_the_serializer
             * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_serializers.html
             */

            'serializer' => null,

            /**
             * Connection Factory
             *
             * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_setting_a_custom_connectionfactory
             */

            'connectionFactory' => null,

            /**
             * Endpoint
             *
             * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_set_the_endpoint_closure
             */

            'endpoint' => null,

        ],

        'testing' => [

            'hosts' => [
                [
                    'host' => 'localhost',
                    'port' => 9200,
                    'scheme' => null,
                    'user' => null,
                    'pass' => null,
                ],
            ],

            'sslVerification' => null,

            'logging' => false,

            'logPath' => storage_path('logs/elasticsearch.log'),

            'logLevel' => Monolog\Logger::INFO,

            'retries' => null,

            /**
             * The remainder of the configuration options can almost always be left
             * as-is unless you have specific reasons to change them.  Refer to the
             * appropriate sections in the Elasticsearch documentation for what each option
             * does and what values it expects.
             */

            'sniffOnStart' => false,

            'connectionPool' => null,

            'connectionSelector' => null,

            'serializer' => null,

            'connectionFactory' => null,

            'endpoint' => null,

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
                        'name' => [
                            'tokenizer' => 'standard',
                            'filter' => [
                                'lowercase',
                                'english_stop',
                                'asciifolding',
                                'shingle',
                            ],
                        ],
                    ],
                ],
            ],
            // Mappings are defined in SearchServiceProvider
            // https://laracasts.com/discuss/channels/laravel/how-to-access-auth-user-details-in-config-files
        ],

    ],

    'cache_enabled' => (bool) env('ELASTICSEARCH_CACHE_ENABLED', false),
    'cache_ttl' => env('ELASTICSEARCH_CACHE_TTL', 60 * 30), // Half an hour default
    'cache_version' => env('ELASTICSEARCH_CACHE_VERSION', 1),

];
