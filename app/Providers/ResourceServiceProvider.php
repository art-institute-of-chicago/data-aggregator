<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ResourceServiceProvider extends ServiceProvider
{

    public function boot()
    {
        //
    }

    public function register()
    {

        $this->app->singleton('Resources', function($app) {

            return new class {

                /**
                 * Array of resources (endpoints), mapped to their models.
                 * Currently, only top-level endpoints are tracked.
                 *
                 * @var array
                 */
                private $resources;

                /**
                 * Array of class names for inbound transformers mapped to models.
                 * For now, generated on first call by scanning the directory.
                 *
                 * Each object in the array looks like this:
                 *
                 *     [
                 *        'source' => 'Collections',
                 *        'model' => \App\Models\Collections\Artwork::class,
                 *        'transformer' => \App\Transformers\Inbound\Collections\Artwork::class,
                 *     ]
                 *
                 * @var array
                 */
                private $transformers;

                /**
                 * Init this class. Transforms `$resources` into an Eloquent collection.
                 */
                public function __construct()
                {
                    $this->resources = config('resources.outbound.base');
                    $this->resources = collect( $this->resources );

                    $this->inbound = config('resources.inbound');
                    $this->inbound = collect( $this->inbound );
                }

                public function getModelForEndpoint( $endpoint )
                {
                    $resource = $this->resources->firstWhere('endpoint', $endpoint);

                    $model = $resource['model'] ?? null;

                    if( !$model )
                    {
                        throw new \Exception('You must define a model for outbound endpoint `' . $endpoint . '` in ResourceServiceProvider.');
                    }

                    return $model;
                }

                public function getEndpointForModel( $model )
                {
                    $model = $this->getCleanModel( $model );

                    $resource = $this->resources->firstWhere('model', $model);

                    $endpoint = $resource['endpoint'] ?? null;

                    if( !$endpoint )
                    {
                        throw new \Exception('You must define an outbound endpoint for model `' . $model . '` in ResourceServiceProvider.');
                    }

                    return $endpoint;
                }

                public function getParent( $endpoint )
                {

                    $resource = $this->resources->firstWhere('endpoint', $endpoint);

                    return $resource['scope_of'] ?? null;
                }

                public function getInboundTransformerForModel( $model, $source )
                {

                    if( !$this->transformers )
                    {
                        $this->transformers = $this->getInboundTransformerMapping();
                    }

                    $model = $this->getCleanModel( $model );

                    // Get the right transformer mapping
                    $mapping = $this->transformers
                        ->where('model', $model)
                        ->where('source', $source)
                        ->first();

                    return $mapping['transformer'];

                }

                private function getCleanModel( $model )
                {

                    // Remove \ from start of $model if present
                    $model = ltrim( $model, '\\' );

                    return $model;

                }

                public function getInboundTransformerMapping()
                {

                    // TODO: Re-examine this helper
                    $models = allModels();

                    // We want this to be a collection
                    $models = collect( $models );

                    $transformers = $models->map( function( $model ) {

                        $model = $this->getCleanModel( $model );

                        $source = explode('\\', $model)[2]; // e.g. Collections

                        $inbound = $this->inbound
                            ->where('model', $model)
                            ->where('source', $source )
                            ->first();

                        if (isset($inbound)) {

                            $transformer = $inbound['transformer'];

                        } else {

                            $transformer = str_replace('Models', 'Transformers\\Inbound', $model);

                            if( !class_exists( $transformer ) )
                            {
                                $parent = array_slice( explode('\\', get_parent_class( $model )), -1, 1)[0];

                                $transformer = '\\App\\Transformers\\Inbound\\' . $source . '\\' . $parent;

                                if( !class_exists( $transformer ) )
                                {
                                    $transformer = '\\App\\Transformers\\Inbound\\' . $source . 'Transformer';

                                    if( !class_exists( $transformer ) )
                                    {
                                        $transformer = \App\Transformers\Inbound\AbstractTransformer::class;
                                    }
                                }
                            }
                        }

                        return [
                            'model' => $model,
                            'transformer' => $transformer,
                            'source' => $source,
                        ];

                    });

                    $transformers = $transformers->filter();

                    return $transformers;

                }

            };

        });

    }
}
