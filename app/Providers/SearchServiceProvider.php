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

        config( [ 'elasticsearch.indexParams.body.mappings' => app('Search')->getElasticsearchMappings() ] );

    }


    /**
     * Register a search application service, which tracks Searchable models.
     *
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('Search', function($app) {

            return new class {

                private $models = [

                    \App\Models\Collections\Agent::class,
                    \App\Models\Collections\Artwork::class,
                    \App\Models\Collections\Category::class,
                    \App\Models\Collections\Department::class,
                    \App\Models\Collections\Exhibition::class,
                    \App\Models\Collections\Gallery::class,

                    \App\Models\Collections\Image::class,
                    \App\Models\Collections\Link::class,
                    \App\Models\Collections\Sound::class,
                    \App\Models\Collections\Text::class,
                    \App\Models\Collections\Video::class,

                    \App\Models\Shop\Category::class,
                    \App\Models\Shop\Product::class,

                    \App\Models\Membership\Event::class,

                    \App\Models\Mobile\Tour::class,
                    \App\Models\Mobile\TourStop::class,

                    \App\Models\Dsc\Publication::class,
                    \App\Models\Dsc\Section::class,

                    \App\Models\StaticArchive\Site::class,

                ];

                public function __construct()
                {
                    $this->models = collect( $this->models );
                }

                public function getElasticsearchMappings() {

                    $mappings = $this->models->map( function( $model ) {
                        return $model::instance()->elasticsearchMapping();
                    });

                    return array_merge( ... $mappings );

                }

            };

        });

    }

}
