<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\BaseModel;
use App\Scopes\PublishedScope;

class RestrictContent
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
        // Define what to show to anonymous users
        if (Gate::denies('restricted-access')) {
            BaseModel::addRestrictContentScopes();
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

        if (
            in_array($endpoint, [
            'articles',
            'digital-publications',
            'educator-resources',
            'generic-pages',
            'press-releases',
            'printed-publications',
            'highlights',
            'static-pages',
            'web-exhibitions',

            // WEB-1929: Re-enable restriction when ready!
            // 'events',
            ])
        ) {
            $restrictions = array_merge($restrictions, PublishedScope::forSearch());
        }

        if (
            in_array($endpoint, [
            'events',
            'event-occurrences',
            ])
        ) {
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

        return count($restrictions) == 1 ? $restrictions[0] : $restrictions;
    }
}
