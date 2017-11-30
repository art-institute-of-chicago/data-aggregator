<?php

namespace App\Providers;

use Elasticsearch;
use Laravel\Scout\EngineManager;
use ScoutEngines\Elasticsearch\ElasticsearchEngine;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        /**
         * Override the laravel-scout-elastic package boot method so we can use
         * the connections created in laravel-elasticsearch.
         */
        app(EngineManager::class)->extend('elasticsearch', function($app) {
            return new ElasticsearchEngine(Elasticsearch::connection(),
                config('scout.elasticsearch.index')
            );
        });

    }

}
