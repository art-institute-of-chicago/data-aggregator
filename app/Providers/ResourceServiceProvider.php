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
                 * @TODO Should this live in a config file?
                 * @TODO Use this space to tag things as searchable?
                 *
                 * @var array
                 */
                private $resources = [
                    [
                        'endpoint' => 'artworks',
                        'model' => \App\Models\Collections\Artwork::class,
                    ],
                    [
                        'endpoint' => 'agents',
                        'model' => \App\Models\Collections\Agent::class,
                    ],
                    [
                        'endpoint' => 'artists',
                        'model' => \App\Models\Collections\Agent::class,
                        'scope' => 'agents',
                    ],
                    [
                        'endpoint' => 'venues',
                        'model' => \App\Models\Collections\Agent::class,
                        'scope' => 'agents',
                    ],
                    [
                        'endpoint' => 'agent-places',
                        'model' => \App\Models\Collections\AgentPlace::class,
                    ],
                    [
                        'endpoint' => 'agent-types',
                        'model' => \App\Models\Collections\AgentType::class,
                    ],
                    [
                        'endpoint' => 'artwork-types',
                        'model' => \App\Models\Collections\ArtworkType::class,
                    ],
                    [
                        'endpoint' => 'categories',
                        'model' => \App\Models\Collections\Category::class,
                    ],
                    [
                        'endpoint' => 'departments',
                        'model' => \App\Models\Collections\Category::class,
                        'scope' => 'departments',
                    ],
                    [
                        'endpoint' => 'places',
                        'model' => \App\Models\Collections\Place::class,
                    ],
                    [
                        'endpoint' => 'catalogues',
                        'model' => \App\Models\Collections\Catalogue::class,
                    ],
                    [
                        'endpoint' => 'artwork-catalogues',
                        'model' => \App\Models\Collections\ArtworkCatalogue::class,
                    ],
                    [
                        'endpoint' => 'galleries',
                        'model' => \App\Models\Collections\Gallery::class,
                    ],
                    [
                        'endpoint' => 'exhibitions',
                        'model' => \App\Models\Collections\Exhibition::class,
                    ],
                    [
                        'endpoint' => 'exhibition-agents',
                        'model' => \App\Models\Collections\AgentExhibition::class,
                    ],
                    [
                        'endpoint' => 'terms',
                        'model' => \App\Models\Collections\Term::class,
                    ],
                    [
                        'endpoint' => 'assets',
                        'model' => \App\Models\Collections\Asset::class,
                    ],
                    [
                        'endpoint' => 'images',
                        'model' => \App\Models\Collections\Image::class,
                    ],
                    [
                        'endpoint' => 'videos',
                        'model' => \App\Models\Collections\Video::class,
                    ],
                    [
                        'endpoint' => 'links',
                        'model' => \App\Models\Collections\Link::class,
                    ],
                    [
                        'endpoint' => 'sounds',
                        'model' => \App\Models\Collections\Sound::class,
                    ],
                    [
                        'endpoint' => 'texts',
                        'model' => \App\Models\Collections\Text::class,
                    ],
                    [
                        'endpoint' => 'shop-categories',
                        'model' => \App\Models\Shop\Category::class,
                    ],
                    [
                        'endpoint' => 'products',
                        'model' => \App\Models\Shop\Product::class,
                    ],
                    [
                        'endpoint' => 'legacy-events',
                        'model' => \App\Models\Membership\LegacyEvent::class,
                    ],
                    [
                        'endpoint' => 'ticketed-events',
                        'model' => \App\Models\Membership\TicketedEvent::class,
                    ],
                    [
                        'endpoint' => 'tours',
                        'model' => \App\Models\Mobile\Tour::class,
                    ],
                    [
                        'endpoint' => 'tour-stops',
                        'model' => \App\Models\Mobile\TourStop::class,
                    ],
                    [
                        'endpoint' => 'mobile-sounds',
                        'model' => \App\Models\Mobile\Sound::class,
                    ],
                    [
                        'endpoint' => 'publications',
                        'model' => \App\Models\Dsc\Publication::class,
                    ],
                    [
                        'endpoint' => 'sections',
                        'model' => \App\Models\Dsc\Section::class,
                    ],
                    [
                        'endpoint' => 'sites',
                        'model' => \App\Models\StaticArchive\Site::class,
                    ],
                    [
                        'endpoint' => 'library-materials',
                        'model' => \App\Models\Library\Material::class,
                    ],
                    [
                        'endpoint' => 'library-terms',
                        'model' => \App\Models\Library\Term::class,
                    ],
                    [
                        'endpoint' => 'archive-images',
                        'model' => \App\Models\Archive\ArchiveImage::class,
                    ],
                ];

                /**
                 * Init this class. Transforms `$resources` into an Eloquent collection.
                 */
                public function __construct()
                {
                    $this->resources = collect( $this->resources );
                }

                public function getModelForEndpoint( $endpoint )
                {
                    $resource = $this->resources->firstWhere('endpoint', $endpoint);

                    return $resource['model'] ?? null;
                }

                public function getEndpointForModel( $model )
                {

                    // Remove \ from start of $model if present
                    $model = ltrim( $model, '\\' );

                    $resource = $this->resources->firstWhere('model', $model);

                    return $resource['endpoint'] ?? null;
                }

                public function getParent( $endpoint )
                {

                    $resource = $this->resources->firstWhere('endpoint', $endpoint);

                    return $resource['scope'] ?? null;
                }

            };

        });

    }
}
