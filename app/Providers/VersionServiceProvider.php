<?php

namespace App\Providers;

use Elasticsearch;
use Laravel\Scout\EngineManager;
// use ScoutEngines\Elasticsearch\ElasticsearchEngine;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

// TODO: Remove this after we're ready to handle exceptions
use App\ElasticsearchEngine;

class VersionServiceProvider extends ServiceProvider
{

    /**
     * Register any application service.
     */
    public function register()
    {
        config(['aic.version' => trim(file_get_contents(__DIR__ . '/../../VERSION'))]);
    }

}
