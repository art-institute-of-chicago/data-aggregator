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
                 * @TODO Use this space to tag things as searchable?
                 *
                 * @var array
                 */
                private $resources;

                /**
                 * Init this class. Transforms `$resources` into an Eloquent collection.
                 */
                public function __construct()
                {
                    $this->resources = config('resources.outbound.base');
                    $this->resources = collect( $this->resources );
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

                    // Remove \ from start of $model if present
                    $model = ltrim( $model, '\\' );

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

            };

        });

    }
}
