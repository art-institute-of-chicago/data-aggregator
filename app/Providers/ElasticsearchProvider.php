<?php

namespace App\Providers;

use App\Console\Commands\Elasticsearch\AliasCreateCommand;
use App\Console\Commands\Elasticsearch\AliasRemoveIndexCommand;
use App\Console\Commands\Elasticsearch\AliasSwitchIndexCommand;
use App\Console\Commands\Elasticsearch\IndexCreateCommand;
use App\Console\Commands\Elasticsearch\IndexCreateOrUpdateMappingCommand;
use App\Console\Commands\Elasticsearch\IndexDeleteCommand;
use App\Console\Commands\Elasticsearch\IndexExistsCommand;
use App\Providers\Engines\ElasticsearchEngine;
use App\Providers\Managers\ElasticsearchManager;
use Database\Factories\ElasticsearchFactory;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Laravel\Scout\EngineManager;


/**
 * Class ServiceProvider
 */
class ElasticsearchProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->setUpConfig();
        $this->setUpConsoleCommands();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->singleton('elasticsearch.factory', function($app) {
            return new ElasticsearchFactory();
        });

        $app->singleton('elasticsearch', function($app) {
            return new ElasticsearchManager($app, $app['elasticsearch.factory']);
        });

        $app->alias('elasticsearch', ElasticsearchManager::class);

        $app->singleton(Client::class, function(Container $app) {
            return $app->make('elasticsearch')->connection();
        });

        resolve(EngineManager::class)->extend('elasticsearch', function () {
            return new ElasticsearchEngine(
                ClientBuilder::create()
                    ->setHosts(config('scout.elasticsearch.hosts'))
                    ->setApiKey(config('scout.elasticsearch.api_key'))
                    ->build(),
                config('scout.elasticsearch.index'),
                false,
                config('scout.elasticsearch.perModelIndex', false)
            );
        });
    }

    protected function setUpConfig(): void
    {
        $source = config_path('elasticsearch.php');

        $this->publishes([$source => config_path('elasticsearch.php')], 'config');

        $this->mergeConfigFrom($source, 'elasticsearch');
    }

    private function setUpConsoleCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                AliasCreateCommand::class,
                AliasRemoveIndexCommand::class,
                AliasSwitchIndexCommand::class,
                IndexCreateCommand::class,
                IndexCreateOrUpdateMappingCommand::class,
                IndexDeleteCommand::class,
                IndexExistsCommand::class,
            ]);
        }
    }
}
