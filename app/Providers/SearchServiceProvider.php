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
            return new ElasticsearchEngine( Elasticsearch::connection(),
                config('scout.elasticsearch.index') . '-', // Acts as a prefix
                true // Use an index per model?
            );
        });

        // Bind the Search singleton's output into our config
        app('Search')->updateElasticsearchConfig();

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
                 *
                 * An explicit listing is (currently) preferred for performance reasons and due to
                 * difficulties with creating indexes for polymorphic models (Assets and Agents).
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
                        return $this->getElasticsearchMapping( $model );
                    });

                    return $mappings->isNotEmpty() ? array_merge( ... $mappings ) : [];

                }

                /**
                 * Return Elasticsearch field mapping in conformance with official ES PHP syntax.
                 * Abstracted into own method here to ease potential later modification.
                 *
                 * @return array
                 */
                public function getElasticsearchMapping( $model ) {

                    return $model::instance()->elasticsearchMapping();

                }

                /**
                 * Returns an array containing namespaced classnames of models with the Searchable trait.
                 *
                 * @return array
                 */
                public function getSearchableModels() {

                    return $this->models->all();

                }

                /**
                 * Add model classname to searchable keychain and update the config.
                 */
                public function addSearchableModel( $model ) {

                    $this->models->push( $model );

                    $this->updateElasticsearchConfig();

                }

                /**
                 * Update values from `config/elasticsearch.php` with our singleton's output
                 */
                public function updateElasticsearchConfig() {

                    config( [ 'elasticsearch.indexParams.body.mappings' => $this->getElasticsearchMappings() ] );

                }

            };

        });

    }

}