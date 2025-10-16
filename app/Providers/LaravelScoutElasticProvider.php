<?php

namespace App\Providers;

use Exception;
use Elasticsearch\ClientBuilder;
use Laravel\Scout\EngineManager;
use Illuminate\Support\ServiceProvider;
use App\Providers\Engines\ElasticsearchEngine;

class LaravelScoutElasticProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->ensureElasticClientIsInstalled();

        resolve(EngineManager::class)->extend('elasticsearch', function () {
            return new ElasticsearchEngine(
                ClientBuilder::create()
                    ->setHosts(config('scout.elasticsearch.hosts'))
                    ->build(),
                    config('scout.elasticsearch.index'),
                    config('scout.elasticsearch.perModelIndex', false)
            );
        });
    }

    /**
     * Ensure the Elastic API client is installed.
     *
     * @return void
     *
     * @throws \Exception
     */
    protected function ensureElasticClientIsInstalled()
    {
        if (class_exists(ClientBuilder::class)) {
            return;
        }

        throw new Exception('Please install the Elasticsearch PHP client: elasticsearch/elasticsearch.');
    }
}
