<?php

namespace App\Providers;

use Laravel\Scout\EngineManager;
use Illuminate\Support\ServiceProvider;
use ScoutEngines\Elasticsearch\ElasticsearchEngine;
use Elasticsearch;

/**
 * Override the laravel-scout-elastic package boot method so we can use 
 * the connections created in laravel-elasticsearch.
 */
class ElasticsearchProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        app(EngineManager::class)->extend('elasticsearch', function($app) {
            return new ElasticsearchEngine(Elasticsearch::connection(),
                config('scout.elasticsearch.index')
            );
        });

    }

}
