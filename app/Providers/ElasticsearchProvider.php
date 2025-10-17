<?php

namespace App\Providers;

use App\Console\Commands\Elasticsearch\AliasCreateCommand;
use App\Console\Commands\Elasticsearch\AliasRemoveIndexCommand;
use App\Console\Commands\Elasticsearch\AliasSwitchIndexCommand;
use App\Console\Commands\Elasticsearch\IndexCreateCommand;
use App\Console\Commands\Elasticsearch\IndexCreateOrUpdateMappingCommand;
use App\Console\Commands\Elasticsearch\IndexDeleteCommand;
use App\Console\Commands\Elasticsearch\IndexExistsCommand;
use App\Providers\Managers\ElasticsearchManager;
use Database\Factories\ElasticsearchFactory;
use Elastic\Elasticsearch\Client;
use Illuminate\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

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
    }

    protected function setUpConfig(): void
    {
        $source = config_path('elasticsearch.php');

        if ($this->app instanceof LaravelApplication) {
            $this->publishes([$source => config_path('elasticsearch.php')], 'config');
        }

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
