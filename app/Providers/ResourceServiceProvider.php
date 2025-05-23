<?php

namespace App\Providers;

use App\Services\EmbeddingService;
use Illuminate\Support\ServiceProvider;

class ResourceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('Resources', function ($app) {
            return new class () {
                /**
                 * Array of resources (endpoints), mapped to their models.
                 * Currently, only top-level endpoints are tracked.
                 *
                 * @var array|\Illuminate\Support\Collection
                 */
                private $outbound;

                /**
                 * Array of class names for inbound transformers mapped to models.
                 *
                 * Each object in the array looks like this:
                 *
                 *     [
                 *        'source' => 'collections',
                 *        'model' => \App\Models\Collections\Artwork::class,
                 *        'transformer' => \App\Transformers\Inbound\Collections\Artwork::class,
                 *     ]
                 *
                 * @var array|\Illuminate\Support\Collection
                 */
                private $inbound;

                public function __construct()
                {
                    $this->outbound = config('resources.outbound.base');
                    $this->outbound = collect($this->outbound);

                    $this->inbound = config('resources.inbound');
                    $this->inbound = collect($this->inbound)->map(function ($resources, $source) {
                        return array_map(function ($resource, $endpoint) use ($source) {
                            return [
                                'source' => strtolower($source),
                                'endpoint' => $endpoint,
                                'model' => $resource['model'],
                                'transformer' => $resource['transformer'],
                            ];
                        }, $resources, array_keys($resources));
                    })->values()->collapse();
                }

                private function getResourceForEndpoint($endpoint)
                {
                    do {
                        $resource = $this->outbound->firstWhere('endpoint', $endpoint);
                        $endpoint = $resource['alias_of'] ?? $endpoint;
                    } while (isset($resource['alias_of']));

                    return $resource;
                }

                public function getModelForEndpoint($endpoint)
                {
                    $resource = $this->getResourceForEndpoint($endpoint);

                    $model = $resource['model'] ?? null;

                    if (!$model) {
                        throw new \Exception('You must define a model for outbound endpoint `' . $endpoint . '` in ResourceServiceProvider.');
                    }

                    return $model;
                }

                public function getTransformerForEndpoint($endpoint)
                {
                    $resource = $this->getResourceForEndpoint($endpoint);

                    $transformer = $resource['transformer'] ?? null;

                    if (!$transformer) {
                        throw new \Exception('You must define a transformer for outbound endpoint `' . $endpoint . '` in ResourceServiceProvider.');
                    }

                    return $transformer;
                }

                public function getEndpointForModel($model)
                {
                    $model = $this->getCleanModel($model);

                    $resource = $this->outbound->firstWhere('model', $model);

                    $endpoint = $resource['endpoint'] ?? null;

                    if (!$endpoint) {
                        throw new \Exception('You must define an outbound endpoint for model `' . $model . '` in ResourceServiceProvider.');
                    }

                    if (isset($resource['scope_of'])) {
                        do {
                            $resource = $this->outbound->firstWhere('endpoint', $endpoint);
                            $endpoint = $resource['scope_of'] ?? $endpoint;
                        } while (isset($resource['scope_of']) && $resource['scope_of'] !== $endpoint);
                    }

                    return $endpoint;
                }

                public function getTransformerForModel($model)
                {
                    $model = $this->getCleanModel($model);

                    $resource = $this->outbound->firstWhere('model', $model);

                    $transformer = $resource['transformer'] ?? null;

                    if (!$transformer) {
                        throw new \Exception('You must define a transformer for model `' . $model . '` in ResourceServiceProvider.');
                    }

                    return $transformer;
                }

                public function isModelSearchable($model)
                {
                    $model = $this->getCleanModel($model);

                    $resource = $this->outbound->firstWhere('model', $model);

                    return $resource['is_searchable'] ?? false;
                }

                public function getParent($endpoint)
                {
                    $resource = $this->getResourceForEndpoint($endpoint);

                    return $resource['scope_of'] ?? null;
                }

                public function isRestricted($endpoint)
                {
                    $resource = $this->getResourceForEndpoint($endpoint);

                    return $resource['is_restricted'] ?? false;
                }

                public function getRetrictedFieldNamesForEndpoint($endpoint)
                {
                    $transformerClass = $this->getTransformerForEndpoint($endpoint);

                    $mappedFields = (new $transformerClass())->getMappedFields();

                    $restrictedFields = array_filter($mappedFields, function ($mappedField) {
                        return ($mappedField['is_restricted'] ?? false) === true;
                    });

                    return array_keys($restrictedFields);
                }

                public function getInboundTransformerForModel($model, $source)
                {
                    $model = $this->getCleanModel($model);

                    $resource = $this->inbound
                        ->where('model', $model)
                        ->where('source', strtolower($source))
                        ->first();

                    $transformer = $resource['transformer'] ?? null;

                    if (!$transformer) {
                        throw new \Exception('Define an inbound transformer for model `' . $model . '` and source `' . $source . '` in ResourceServiceProvider.');
                    }

                    return $transformer;
                }

                public function getResourceForInboundEndpoint($endpoint, $source)
                {
                    $resource = $this->inbound
                        ->where('endpoint', $endpoint)
                        ->where('source', strtolower($source))
                        ->first();

                    if (!$resource) {
                        throw new \Exception('Define a resource for endpoint `' . $endpoint . '` and source `' . $source . '` in ResourceServiceProvider.');
                    }

                    return $resource;
                }

                public function getModelForInboundEndpoint($endpoint, $source)
                {
                    $resource = $this->getResourceForInboundEndpoint($endpoint, $source);

                    $model = $resource['model'] ?? null;

                    if (!$model) {
                        throw new \Exception('Define an inbound model for endpoint `' . $endpoint . '` and source `' . $source . '` in ResourceServiceProvider.');
                    }

                    return $model;
                }

                private function getCleanModel($model)
                {
                    // Remove \ from start of $model if present
                    $model = ltrim($model, '\\');

                    return $model;
                }
            };
        });
    }
}
