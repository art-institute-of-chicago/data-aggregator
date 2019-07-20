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
        app(EngineManager::class)->extend('elasticsearch', function ($app) {
            return new ElasticsearchEngine(
                Elasticsearch::connection(),
                config('scout.elasticsearch.index') . '-',
                true // Whether "index" should act like a prefix
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

        $this->app->singleton('Search', function ($app) {

            return new class() {

                /**
                 * Array of models with the Searchable trait. Converted to Eloquent collection on init.
                 *
                 * An explicit listing is (currently) preferred for performance reasons and due to
                 * difficulties with creating indexes for polymorphic models (Assets and Agents).
                 *
                 * @var array
                 */
                private $models;

                /**
                 * Init this class. Transforms `$models` into an Eloquent collection.
                 */
                public function __construct()
                {
                    // TODO: Use the ResourceServiceProvider for this?
                    $resources = config('resources.outbound.base');
                    $resources = collect($resources);

                    // Isolate searchable resources
                    $resources = $resources->filter(function ($resource) {
                        return $resource['is_searchable'] ?? false;
                    });

                    // Grab the models from resource definitions
                    $models = $resources->map(function ($resource) {
                        return $resource['model'];
                    });

                    $this->models = $models;
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

                    $mappings = $this->models->map(function ($model) {
                        return $this->getElasticsearchMapping($model);
                    });

                    return $mappings->isNotEmpty() ? array_merge(...$mappings) : [];

                }

                /**
                 * Return Elasticsearch field mapping in conformance with official ES PHP syntax.
                 * Abstracted into own method here to ease potential later modification.
                 *
                 * @return array
                 */
                public function getElasticsearchMapping($model) {

                    return $model::instance()->elasticsearchMapping();

                }

                /**
                 * Returns an array containing fields to target for simple search for all models.
                 *
                 * @return array
                 */
                public function getDefaultFields($models = null, $isExact = false) {

                    // Fallback to getting default fields for all models
                    if(is_null($models) || $models->count() < 1)
                    {
                        $models = $this->models;
                    }

                    $fields = $models->map(function ($model) use ($isExact) {
                        return $this->getDefaultFieldsForModel($model, $isExact);
                    });

                    $fields = $fields->isNotEmpty() ? array_merge(...$fields) : [];

                    // Remove duplicate field names, e.g. `content`
                    $fields = array_unique($fields);

                    // Reindex consequtively
                    $fields = array_values($fields);

                    // TODO: Once we start boosting individual fields on query-time, determine
                    // what should be done in cases where a simple search is performed across
                    // multiple indexes, which contain different boost values for fields with
                    // the same names. I'm leaning towards using the highest boost value.

                    return $fields;

                }

                /**
                 * Returns an array containing fields to target for simple search for one endpoint.
                 *
                 * @return array
                 */
                public function getDefaultFieldsForEndpoints($endpoints, $isExact = false) {

                    $models = collect($endpoints)->map(function ($endpoint) {
                        return app('Resources')->getModelForEndpoint($endpoint);
                    });

                    return $this->getDefaultFields($models, $isExact);

                }

                /**
                 * Returns an array containing fields to target for simple search for one endpoint.
                 *
                 * @return array
                 */
                public function getDefaultFieldsForEndpoint($endpoint) {

                    $model = app('Resources')->getModelForEndpoint($endpoint);

                    return $this->getDefaultFieldsForModel($model);

                }

                /**
                 * Returns an array containing fields to target for simple search for one model.
                 *
                 * @return array
                 */
                private function getDefaultFieldsForModel($model, $isExact = false) {

                    // TODO: Class name must be a valid object or a string
                    // Fix this error when an unknown resource gets passed
                    return $model::instance()->getDefaultSearchFields($isExact);

                }

                /**
                 * Returns a string containing the full index name for the model. Includes prefix.
                 *
                 * @return string
                 */
                public function getIndexForModel($model, $prefix = null) {

                    $prefix = $prefix ?? env('ELASTICSEARCH_INDEX');

                    return $prefix . '-' . $model::instance()->searchableIndex();

                }

                /**
                 * Returns a string containing the type for the model.
                 *
                 * @return string
                 */
                public function getTypeForModel($model) {

                    return $model::instance()->searchableType();

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
                public function addSearchableModel($model) {

                    $this->models->push($model);

                    $this->updateElasticsearchConfig();

                }

                /**
                 * Update values from `config/elasticsearch.php` with our singleton's output
                 */
                public function updateElasticsearchConfig() {

                    config(['elasticsearch.indexParams.body.mappings' => $this->getElasticsearchMappings()]);

                }

                /**
                 * Given an endpoint, retrieve index, type, and search scope settings.
                 * Requires ResourceServiceProvider.
                 *
                 * @param $endpoint string
                 * @return array
                 */
                public function getSearchScopeForEndpoint($endpoint)
                {

                    $model = app('Resources')->getModelForEndpoint($endpoint);

                    $resource = app('Resources')->getParent($endpoint) ?? $endpoint;

                    // Defaults
                    $settings = [
                        'index' => $this->getIndexForModel($model),
                        'type' => $this->getTypeForModel($model),
                    ];

                    // ex. `searchScopeGalleries` for `galleries` endpoint in model `Place`
                    $searchScopeMethod = 'searchScope' . Str::studly($endpoint);

                    if(method_exists($model, $searchScopeMethod))
                    {

                        $scope = $model::$searchScopeMethod();

                        $settings['scope'] = $this->getScopedQuery($resource, $scope);

                    }

                    // ex. `searchBoostArtworks` for `artworks` endpoint boosts `is_on_view`
                    $searchBoostMethod = 'searchBoost' . Str::studly($endpoint);

                    if(method_exists($model, $searchBoostMethod))
                    {

                        $boost = $model::$searchBoostMethod();

                        $settings['boost'] = $this->getScopedQuery($resource, $boost);

                    }

                    // ex. `searchFunctionScoreArtworks` for `artworks` endpoint applies `pageviews` and `boost_rank`
                    $searchFunctionScoreMethod = 'searchFunctionScore' . Str::studly($endpoint);

                    if(method_exists($model, $searchFunctionScoreMethod))
                    {

                        // TODO: Inject `getScopedQuery` into the filter..?
                        $settings['function_score'] = $model::$searchFunctionScoreMethod();

                    }

                    return $settings;

                }

                public function getScopedQuery($resource, $scope)
                {

                    if (is_array($resource))
                    {
                        $query = [
                            'terms' => [
                                'api_model' => $resource,
                            ],
                        ];
                    } else {
                        $query = [
                            'term' => [
                                'api_model' => $resource,
                            ],
                        ];
                    }

                    if (Arr::isAssoc($scope)) {
                        $scope = [$scope];
                    }

                    return [
                        'bool' => [
                            'should' => [
                                [
                                    'bool' => [
                                        'must' => [
                                            [$query],
                                            $scope,
                                        ],
                                    ],
                                ],
                                [
                                    'bool' => [
                                        'must_not' => [
                                            $query,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ];

                }

            };

        });

    }

}
