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

        // Bind the Search singleton's output into our config
        config( [ 'elasticsearch.indexParams.body.mappings' => app('Search')->getElasticsearchMappings() ] );

    }


    /**
     * Register a search application service, which tracks Searchable models.
     */
    public function register()
    {

        $this->app->singleton('Search', function($app) {

            return new class {

                /**
                 * Array of models with the Searchable trait. Converted to Eloquent collection on init.
                 * An explicit listing is (currently) preferred for performance reasons, and to avoid
                 * creating indexes for parents of some polymorphic models (i.e. Assets).
                 *
                 * @var array
                 */
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

                /**
                 * Init this class. Transforms `$models` into an Eloquent collection.
                 */
                public function __construct()
                {
                    $this->models = collect( $this->models );
                }

                /**
                 * Get an array containing Elasticsearch type mappings in conformance with the official ES PHP syntax.
                 * Meant for feeding into `config('elasticsearch.indexParams.body.mappings')`.
                 *
                 * @link https://laracasts.com/discuss/channels/laravel/how-to-access-auth-user-details-in-config-files
                 *
                 * @return array
                 */
                public function getElasticsearchMappings() {

                    $mappings = $this->models->map( function( $model ) {
                        return $model::instance()->elasticsearchMapping();
                    });

                    return array_merge( ... $mappings );

                }

                /**
                 * Returns an array containing namespaced classnames of models with the Searchable trait.
                 *
                 * @return array
                 */
                public function getSearchableModels() {

                    return $this->models->all();

                }

            };

        });

    }

}
