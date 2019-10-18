<?php

namespace App\Http\Middleware;

use Carbon\Carbon;

use Closure;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Collections\Exhibition;
use App\Models\Shop\Product;
use App\Models\Web\Article;
use App\Models\Web\DigitalCatalog;
use App\Models\Web\EducatorResource;
use App\Models\Web\Event;
use App\Models\Web\EventOccurrence;
use App\Models\Web\Exhibition as WebExhibition;
use App\Models\Web\GenericPage;
use App\Models\Web\PressRelease;
use App\Models\Web\PrintedCatalog;
use App\Models\Web\Selection;
use App\Models\Web\Sponsor;
use App\Models\Web\StaticPage;

use App\Scopes\PublishedScope;

class RestrictContent
{
    /**
     * Handle an incoming request.
     *
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        // Define what to show to anonymous users
        if (Gate::denies('restricted-access')) {
            Article::addGlobalScope(new PublishedScope);
            DigitalCatalog::addGlobalScope(new PublishedScope);
            EducatorResource::addGlobalScope(new PublishedScope);
            GenericPage::addGlobalScope(new PublishedScope);
            PressRelease::addGlobalScope(new PublishedScope);
            PrintedCatalog::addGlobalScope(new PublishedScope);
            Selection::addGlobalScope(new PublishedScope);
            Sponsor::addGlobalScope(new PublishedScope);
            StaticPage::addGlobalScope(new PublishedScope);
            WebExhibition::addGlobalScope(new PublishedScope);
            Event::addGlobalScope(new PublishedScope);

            Event::addGlobalScope('is-private', function (Builder $builder) {
                $builder->where('is_private', '=', false);
            });

            EventOccurrence::addGlobalScope('is-private', function (Builder $builder) {
                $builder->where('is_private', '=', false);
            });

            Product::addGlobalScope('is-active', function (Builder $builder) {
                $builder->where('active', '=', true);
            });

            Exhibition::addGlobalScope('is-web-exhibition-published', function (Builder $builder) {
                $builder->leftJoin('web_exhibitions', 'exhibitions.citi_id', '=', 'web_exhibitions.datahub_id')

                    // Show all past exhibitions, accounting for some of the funky ways we've catalogued exhibitions in the past
                    ->where(function ($query) {
                        $query->where('date_aic_start', '<=', Carbon::today())
                            ->where(function ($query2) {
                                $query2->where('date_aic_end', '<=', Carbon::today())
                                    ->orWhere('date_aic_start', '<', Carbon::createMidnightDate(2011, 1, 1));
                            });
                    })

                    // For present and future exhibitions, only show if they're published on the web
                    ->orWhere('web_exhibitions.is_published', '=', true);
            });
        }

        return $next($request);
    }

    /**
     * Mimics \App\Providers\ResourceServiceProvider and \App\Providers\SearchServiceProvider
     *
     * @todo Move this elsewhere so it can be bound in config/resources/outbound.php?
     */
    public static function getSearchRestrictForEndpoint($endpoint)
    {
        $restrictions = [];

        if (in_array($endpoint, [
            'articles',
            'digital-catalogs',
            'educator-resources',
            'generic-pages',
            'press-releases',
            'printed-catalogues',
            'selections',
            'sponsors',
            'static-pages',
            'web-exhibitions',
            'events',
        ])) {
            $restrictions = array_merge($restrictions, PublishedScope::forSearch());
        }

        if (in_array($endpoint, [
            'events',
            'event-occurrences',
        ])) {
            $restrictions[] = [
                'term' => [
                    'is_private' => false,
                ],
            ];
        }

        if ($endpoint == 'products') {
            $restrictions[] = [
                'term' => [
                    'active' => true,
                ],
            ];
        }

        if ($endpoint == 'exhibitions') {
            $restrictions[] = [
                'bool' => [
                    'should' => [
                        [
                            'term' => [
                                'is_published' => true,
                            ]
                        ],
                        [
                            'bool' => [
                                'must' => [
                                    [
                                        'range' => [
                                            'aic_start_at' => [
                                                'lte' => Carbon::today()->toIso8601String(),
                                            ],
                                        ],
                                    ],
                                    [
                                        'bool' => [
                                            'should' => [
                                                [
                                                    'range' => [
                                                        'aic_end_at' => [
                                                            'lte' => Carbon::today()->toIso8601String(),
                                                        ],
                                                    ],
                                                ],
                                                [
                                                    'range' => [
                                                        'aic_start_at' => [
                                                            'lt' => Carbon::createMidnightDate(2011, 1, 1)->toIso8601String(),
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ];
        }

        return $restrictions;
    }
}
