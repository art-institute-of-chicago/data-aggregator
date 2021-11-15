<?php

namespace App\Http\Search;

use Aic\Hub\Foundation\Exceptions\BigLimitException;
use Aic\Hub\Foundation\Exceptions\DetailedException;
use Aic\Hub\Foundation\Exceptions\TooManyResultsException;

use App\Http\Middleware\RestrictContent;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Request as RequestFacade;

class Request
{

    /**
     * Resource targeted by this search request. Derived from API endpoint, or from `resources` param.
     * Accepted as comma-separated string, or as array. Converted to array shortly after `__construct()`.
     *
     * @var array|string
     */
    protected $resources;

    /**
     * Identifier, e.g. for `_explain` queries
     *
     * @var string
     */
    protected $id;

    /**
     * Array of queries needed to isolate any "scoped" resources in this request.
     *
     * @var array
     */
    protected $scopes;

    /**
     * Array of queries needed to boost resources in this request.
     *
     * @var array
     */
    protected $boosts = [];

    /**
     * Array of queries used in a `function_score` wrapper.
     *
     * @var array
     */
    protected $functionScores;

    /**
     * List of allowed Input params for querying.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/5.3/search-request-body.html
     *
     * @var array
     */
    private static $allowed = [

        // Resources can be passed via route, or via query params
        'resources',

        // Required for "Did You Mean"-style suggestions: we need to know the core search string
        // We use `q` b/c it won't cause UnexpectedValueException, if the user uses an official ES Client
        'q',

        // Complex query mode
        'query',
        'sort',

        // Pagination via Elasticsearch conventions
        'from',
        'size',

        // Pagination via Laravel conventions
        'page',
        'limit',

        // Currently unsupported by the official ES PHP Client
        // 'search_after',

        // Choose which fields to return
        'fields',

        // Contexts for autosuggest
        'contexts',

        // Fields to use for aggregations
        'aggs',
        'aggregations',

        // Determines which shards to use, ensures consistent result order
        'preference',

        // Allow clients to turn fuzzy off
        'fuzzy',

        // Allow clients to turn boost off
        'boost',

        // Allow clients to pass custom `function_score` functions
        'functions',
    ];

    /**
     * Default fields to return.
     *
     * @var array
     */
    private static $defaultFields = [
        'id',
        'api_model',
        'api_link',
        'is_boosted',
        'title',
        'thumbnail',
        'timestamp',
    ];

    /**
     * Maximum request `size` for pagination.
     *
     * @TODO Sync this to max size as defined in controllers.
     *
     * @var integer
     */
    private static $maxSize = 100;

    /**
     * Create a new request instance.
     *
     * @param string $resource
     *
     * @return void
     */
    public function __construct($resource = null, $id = null)
    {
        // TODO: Add $input here too..?
        $this->resources = $resource;
        $this->id = $id;
    }

    /**
     * Get params that should be applied to all queries.
     *
     * @TODO: Remove type-related logic when we upgrade to ES 6.0
     *
     * @return array
     */
    public function getBaseParams(array $input)
    {
        // Grab resource target from resource endpoint or `resources` param
        $resources = $this->resources ?? $input['resources'] ?? null;

        // Ensure that resources is an array, not string
        if (is_string($resources)) {
            $resources = explode(',', $resources);
        }

        // Save unfiltered $resources for e.g. getting default fields
        $this->resources = $resources;

        if (is_null($resources)) {
            throw new DetailedException('Missing Parameter', 'You must specify the `resources` parameter.', 403);
        }

        // Filter out any resources that have a parent resource requested as well
        // So e.g. if places and galleries are requested, we'll show places only.
        // Be careful to not filter out self-referrential resources.
        $resources = array_filter($resources, function ($resource) use ($resources) {
            $parent = app('Resources')->getParent($resource);

            return $parent === $resource || !in_array($parent, $resources);
        });

        $resources = array_values(array_unique($resources));

        // Filter out restricted resources for anon users
        // TODO: Alert user about resources that were filtered?
        if (Gate::denies('restricted-access')) {
            $resources = array_filter($resources, function ($resource) {
                return !app('Resources')->isRestricted($resource);
            });
        }

        if (empty($resources)) {
            throw new DetailedException('Restricted Resource', 'You must choose at least one unrestricted resource to search.', 400);
        }

        // Make resources into a Laravel collection
        $resources = collect($resources);

        // Grab settings from our models via the service provider
        $settings = $resources->map(function ($resource) {
            return [
                $resource => app('Search')->getSearchScopeForEndpoint($resource),
            ];
        })->collapse();

        // Collate our indexes and types
        $indexes = $settings->pluck('index')->unique()->all();
        $types = $settings->pluck('type')->unique()->all();

        // These will be injected into the must clause
        $this->scopes = $settings->pluck('scope')->filter()->values()->all();

        // These will be injected into the should clause
        if (!isset($input['q'])) {
            $this->boosts = $settings->pluck('boost')->filter()->values()->all();
        }

        // These will be used to wrap the query in `function_score`
        $this->functionScores = $settings->filter(function ($value, $key) {
            return isset($value['function_score']);
        })->map(function ($item, $key) {
            return $item['function_score'];
        })->all();

        if (isset($input['functions'])) {
            $customScoreFunctions = collect($input['functions'])->filter(function ($value, $key) use ($resources) {
                return $resources->contains($key);
            });

            // Accept both a single function, and an array of functions
            foreach ($customScoreFunctions as $resource => $functions) {
                $functions = !isset($functions[0]) ? [$functions] : $functions;
                $this->functionScores[$resource]['custom'] = $functions;
            }
        }

        return [
            'index' => $indexes,
            'type' => !empty($types) ? implode(',', $types) : null,
            'preference' => Arr::get($input, 'preference'),
        ];
    }

    /**
     * Build full param set (request body) for autocomplete queries.
     *
     * @return array
     */
    public function getAutocompleteParams($requestArgs = null)
    {
        // Strip down the (top-level) params to what our thin client supports
        $input = self::getValidInput($requestArgs);

        // TODO: Handle case where no `q` param is present?
        if (is_null(Arr::get($input, 'q'))) {
            return [];
        }

        // Hardcode $input to only return the fields we want
        $input['fields'] = [
            'id',
            'title',
            'main_reference_number',
            'api_model',
            'subtype', // TODO: Allow each model to specify exposed autocomplete fields?
        ];

        // Suggest also returns `_source`, which we can parse to get the cannonical title
        $params = array_merge(
            $this->getBaseParams($input),
            $this->getFieldParams($input, false)
        );

        // `q` is required here, but we won't send an actual `query`
        $params = $this->addSuggestParams($params, $input, $requestArgs);

        return $params;
    }

    /**
     * Build full param set (request body) for search queries.
     *
     * @return array
     */
    public function getSearchParams($input = null, $withAggregations = true)
    {
        // Strip down the (top-level) params to what our thin client supports
        $input = self::getValidInput($input);

        // Normalize the `boost` param to bool (default: true)
        if (!isset($input['boost'])) {
            $input['boost'] = true;
        } elseif (is_string($input['boost'])) {
            $input['boost'] = filter_var($input['boost'], FILTER_VALIDATE_BOOLEAN);
        }

        $params = array_merge(
            $this->getBaseParams($input),
            $this->getFieldParams($input),
            $this->getPaginationParams($input)
        );

        // This is the canonical body structure. It is required.
        // Various
        $params['body'] = [

            'query' => [
                'bool' => [
                    'must' => [],
                    'should' => [],
                ],
            ],

        ];

        // Add sort into the body, not the request
        $params = $this->addSortParams($params, $input);

        // Add our custom relevancy tweaks into `should`
        if ($input['boost']) {
            $params = $this->addRelevancyParams($params, $input);
        }

        // Add params to isolate "scoped" resources into `must`
        $params = $this->addScopeParams($params, $input);

        // Add params to filter out restricted resources into `must`
        $params = $this->addRestrictParams($params, $input);

        /**
         * 1. If `query` is present, append it to the `must` clause.
         * 2. If `q` is present, add full-text search to the `must` clause.
         * 3. If `q` is absent, show all results.
         */
        if (isset($input['query'])) {
            $params = $this->addFullSearchParams($params, $input);
        }

        if (isset($input['q'])) {
            $params = $this->addSimpleSearchParams($params, $input);
        } else {
            $params = $this->addEmptySearchParams($params);
        }

        // Add Aggregations (facets)
        if ($withAggregations) {
            $params = $this->addAggregationParams($params, $input);
        }

        // Apply `function_score` (if any)
        $params = $this->addFunctionScore($params, $input);

        return $params;
    }

    /**
     * Gather params for an expalin query. Explain queries are identical to search,
     * but they need an id and lack pagination, aggregations, and suggestions.
     *
     * @return array
     */
    public function getExplainParams($input = [])
    {
        $params = $this->getSearchParams($input, false);

        $params['id'] = $this->id;

        unset($params['from']);
        unset($params['size']);

        return $params;
    }

    /**
     * Strip down the (top-level) user-input to what our thin client supports.
     * Allowed-but-omitted params are added as `null`
     *
     * @param array $input
     *
     * @return array
     */
    public static function getValidInput(array $input = null)
    {
        // Grab all user input (query string params or json)
        $input = $input ?: RequestFacade::all();

        // List of allowed user-specified params
        $allowed = self::$allowed;

        // `null` will be the default value for all params
        $defaults = array_fill_keys($allowed, null);

        // Reduce the input set to the params we allow
        $input = array_intersect_key($input, array_flip($allowed));

        // Combine $defaults and $input: we won't have to use is_set, only is_null
        $input = array_merge($defaults, $input);

        return $input;
    }

    /**
     * Get pagination params.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-from-size.html
     *
     * @return array
     */
    private function getPaginationParams(array $input)
    {
        // Elasticsearch params take precedence
        // If that doesn't work, attempt to convert Laravel's pagination into ES params
        $size = $input['size'] ?? $input['limit'] ?? 10;
        $from = $input['from'] ?? null;

        // `from` takes precedence over `page`
        if (!$from && isset($input['page']) && $input['page'] > 0) {
            $from = ($input['page'] - 1) * $size;
        }

        // ES is robust: it can accept `size` or `from` independently

        // If not null, cast these params to int
        // We are using isset() instead of normal ternary to avoid catching `0` as falsey
        if (isset($size)) {
            $size = (int) $size;
        }

        if (isset($from)) {
            $from = (int) $from;
        }

        // Throw an exception if `size` is too big
        if (Gate::denies('restricted-access') && $size > self::$maxSize) {
            throw new BigLimitException();
        }

        if (isset($size) && isset($from)) {
            if (Gate::allows('restricted-access')) {
                $maxResources = config('aic.auth.max_resources_user');
            } else {
                $maxResources = config('aic.auth.max_resources_guest');
            }

            if ($from + $size > $maxResources) {
                throw new TooManyResultsException();
            }
        }

        return [
            // TODO: Determine if this interferes w/ an autocomplete-only search
            'from' => $from,
            'size' => $size,

            // TODO: Re-enable this once the official ES PHP Client supports it
            // 'search_after' => $input['search_after'],
        ];
    }

    /**
     * Determine which fields to return. Set `fields` to `true` to return all.
     * Set `fields` to `false` to return nothing.
     *
     * We currently use `fields` to return `_source` from Elasticsearch, but this
     * may change in the future. The user shouldn't care about how we are storing
     * these fields internally, only what the API outputs.
     *
     * @param mixed $default  Valid `_source` is array, string, null, or bool
     *
     * @return array
     */
    private function getFieldParams(array $input, $default = null)
    {
        $fields = $input['fields'] ?? ($default ?? self::$defaultFields);

        $fields = is_string($fields) ? array_map('trim', explode(',', $fields)) : $fields;

        // Time to filter out restricted fields from request.
        // We cannot target `fields` to specific indexes / resources.
        // What happens if a field is restricted on one resource, but not another?
        if (Gate::denies('restricted-access')) {
            if (count($this->resources) === 1) {
                // If there is only one resource requested, there's no amiguity.
                $restrictedFields = app('Resources')->getRetrictedFieldNamesForEndpoint($this->resources[0]);
                $fields = array_diff($fields, $restrictedFields);
            } else {
                // Otherwise, we need to know what model each record represents.
                // We'll do the field-filtering in Search\Response::data()
                if (!in_array('api_model', $fields)) {
                    $fields[] = 'api_model';
                }
            }
        }

        return [
            '_source' => $fields,
        ];
    }

    /**
     * Determine sort order. Sort must go into the request body, and it cannot be null.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/5.3/search-request-sort.html
     * @link https://github.com/elastic/elasticsearch-php/issues/179
     *
     * @return array
     */
    private function addSortParams(array $params, array $input)
    {
        if (isset($input['sort'])) {
            $params['body']['sort'] = $input['sort'];
        }

        return $params;
    }

    /**
     * Append our own custom queries to tweak relevancy.
     *
     * @return array
     */
    public function addRelevancyParams(array $params, array $input)
    {
        // Don't tweak relevancy if sort is passed
        if (isset($input['sort'])) {
            return $params;
        }

        if (!isset($input['q'])) {
            // Boost anything with `is_boosted` true
            $params['body']['query']['bool']['should'][] = [
                'term' => [
                    'is_boosted' => [
                        'value' => true,
                        'boost' => 1.5,
                    ],
                ],
            ];

            // Add any resource-specific boosts
            foreach ($this->boosts as $boost) {
                $params['body']['query']['bool']['should'][] = $boost;
            }
        }

        return $params;
    }

    /**
     * Wrap the current query in a `function_score` query. Typically, this should be the last method called.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/6.0/query-dsl-function-score-query.html
     *
     * @param array $params
     *
     * @return array
     */
    public function addFunctionScore($params, $input)
    {
        if (empty($this->functionScores) || !isset($this->resources)) {
            return $params;
        }

        // We'll duplicate this, nesting it in `function_score` queries
        $baseQuery = $params['body']['query'];

        // Keep track of this to create a "left over" non-scored query
        $resourcesWithoutFunctions = collect([]);

        $scopedQueries = collect([]);

        foreach ($this->resources as $resource) {
            // Grab the functions for this resource
            $rawFunctions = $this->functionScores[$resource] ?? null;

            // Move on if there are no functions declared for this model
            if (empty($rawFunctions)) {
                $resourcesWithoutFunctions->push($resource);
                continue;
            }

            // Start building the outbound function score array
            $outFunctions = [];

            if ($input['boost']) {
                $outFunctions = array_merge($outFunctions, $rawFunctions['all']);
            }

            if ($input['boost'] && !isset($input['q']) && isset($rawFunctions['except_full_text'])) {
                $outFunctions = array_merge($outFunctions, $rawFunctions['except_full_text']);
            }

            if (isset($rawFunctions['custom'])) {
                $outFunctions = array_merge($outFunctions, $rawFunctions['custom']);
            }

            if (empty($outFunctions)) {
                $resourcesWithoutFunctions->push($resource);
                continue;
            }

            // Build our function score query
            $resourceQuery = [
                'function_score' => [
                    'query' => $baseQuery,
                    'functions' => $outFunctions,
                    'score_mode' => 'max', // TODO: Consider making this an option?
                    'boost_mode' => 'multiply',
                ],
            ];

            // Wrap the query in a scope
            $scopedQuery = app('Search')->getScopedQuery($resource, $resourceQuery);

            $scopedQueries->push($scopedQuery);
        }

        // Add a query for all the leftover resources
        if ($resourcesWithoutFunctions->count() > 0) {
            $scopedQuery = app('Search')->getScopedQuery($resourcesWithoutFunctions->all(), $baseQuery);

            $scopedQueries->push($scopedQuery);
        }

        // Override the existing query with our queries
        $params['body']['query'] = [
            'bool' => [
                'must' => $scopedQueries->all(),
            ],
        ];

        return $params;
    }

    /**
     * Append any search clauses that are needed to isolate scoped resources.
     *
     * @return array
     */
    public function addScopeParams(array $params, array $input)
    {
        if (!isset($this->scopes) || count($this->scopes) < 1) {
            return $params;
        }

        // Assumes that `scopes` has no null members
        $params['body']['query']['bool']['must'][] = [
            'bool' => [
                'should' => $this->scopes,
            ],
        ];

        return $params;
    }

    /**
     * Append any search clauses that are needed to filter out restricted resources.
     *
     * @return array
     */
    public function addRestrictParams(array $params, array $input)
    {
        if (Gate::allows('restricted-access')) {
            return $params;
        }

        foreach ($this->resources as $resource) {
            $restrictions = RestrictContent::getSearchRestrictForEndpoint($resource);

            if (!empty($restrictions)) {
                $params['body']['query']['bool']['must'][] = app('Search')->getScopedQuery($resource, $restrictions);
            }
        }

        return $params;
    }

    /**
     * Get the search params for an empty string search.
     * Empy search requires special handling, e.g. no suggestions.
     *
     * @return array
     */
    private function addEmptySearchParams(array $params)
    {
        // PHP JSON-encodes empty array as [], not {}
        $params['body']['query']['bool']['must'][] = [
            'match_all' => new \stdClass(),
        ];

        return $params;
    }

    /**
     * Append the query params for a simple search. Assumes that `$input['q']` is not null.
     *
     * @TODO Determine which fields to query w/ is_numeric()? See also `lenient` param.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/5.3/common-options.html#fuzziness
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-fuzzy-query.htm
     *
     * @return array
     */
    private function addSimpleSearchParams(array $params, array $input)
    {
        if ($colorParams = $this->getColorParams($params, $input)) {
            return $colorParams;
        }

        // Check for quoted substrings
        $subqueries = explode('"', $input['q']);

        // Assumes that there are no trailing quotes
        // https://stackoverflow.com/a/2076399/1943591
        $withQuotes = array_filter($subqueries, function ($i) {
            return $i & 1;
        }, ARRAY_FILTER_USE_KEY);

        $withoutQuotes = array_filter($subqueries, function ($i) {
            return !($i & 1);
        }, ARRAY_FILTER_USE_KEY);

        // Remove trailing whitespace
        $withQuotes = array_filter(array_map('trim', $withQuotes));
        $withoutQuotes = array_filter(array_map('trim', $withoutQuotes));

        // Exact-match any numeric substrings or accession numbers
        $withoutQuotes = array_filter(array_map(function ($subquery) use (&$withQuotes) {
            $substrings = explode(' ', $subquery);

            $substrings = array_filter(array_map(function ($substring) use (&$withQuotes) {
                if (is_numeric(substr($substring, 0, 1))) {
                    $withQuotes[] = $substring;
                    return null;
                }

                return $substring;
            }, $substrings));

            if (count($substrings) > 0) {
                return implode(' ', $substrings);
            }
        }, $withoutQuotes));

        // Used for silencing an extra phrase query below
        $isExact = count($withQuotes) > 0;

        // Only pull default fields for the resources targeted by this request
        $allFields = app('Search')->getDefaultFieldsForEndpoints($this->resources, false);
        $exactFields = app('Search')->getDefaultFieldsForEndpoints($this->resources, true);

        foreach ($withQuotes as $subquery) {
            $params['body']['query']['bool']['must'][] = [
                'multi_match' => [
                    'query' => str_replace('"', '', $subquery),
                    'fields' => $exactFields,
                    'type' => 'phrase',
                    'boost' => 10,
                ],
            ];
        }

        // Determing if fuzzy searching should be used on this query
        $fuzziness = $this->getFuzzy($input, $input['q']);

        foreach ($withoutQuotes as $subquery) {
            // Pull all docs that match fuzzily into the results
            $params['body']['query']['bool']['must'][] = [
                'multi_match' => [
                    'query' => $subquery,
                    'fuzziness' => $fuzziness,
                    'prefix_length' => 1,
                    'fields' => $allFields,
                ],
            ];
        }

        // Queries below depend on `q`, but act as relevany tweaks
        // Don't tweak relevancy further if sort is passed
        if (isset($input['sort'])) {
            return $params;
        }

        // This acts as a boost for docs that match precisely, if fuzzy search is enabled
        if (!$isExact && ($fuzziness ?? false)) {
            $params['body']['query']['bool']['should'][] = [
                'multi_match' => [
                    'query' => $input['q'],
                    'fields' => $allFields,
                ],
            ];
        }

        // This boosts docs that have multiple terms in close proximity
        // `phrase` queries are relatively expensive, so check for spaces first
        // https://www.elastic.co/guide/en/elasticsearch/guide/current/_improving_performance.html
        if (strpos($input['q'], ' ')) {
            $params['body']['query']['bool']['should'][] = [
                'multi_match' => [
                    'query' => str_replace('"', '', $input['q']),
                    'type' => 'phrase',
                    'slop' => 3, // account for e.g. middle names
                    'fields' => $allFields,
                    'boost' => 10, // See WEB-22
                ],
            ];
        }

        return $params;
    }

    /**
     * Get the search params for a complex search
     *
     * @return array
     */
    private function addFullSearchParams(array $params, array $input)
    {
        // TODO: Validate `query` input to reduce shenanigans
        // TODO: Deep-find `fields` in certain queries + replace them w/ our custom field list
        $params['body']['query']['bool']['must'][] = [
            Arr::get($input, 'query'),
        ];

        return $params;
    }

    /**
     * Append suggest params to query.
     *
     * Both `query` and `q`-only searches support suggestions.
     * Empty searches do not support suggestions.
     *
     * @return array
     */
    public function addSuggestParams(array $params, array $input, $requestArgs = null)
    {
        $params['body']['suggest'] = [
            'text' => Arr::get($input, 'q'),
        ];

        $params = $this->addAutocompleteSuggestParams($params, $input, $requestArgs);

        return $params;
    }

    /**
     * Append autocomplete suggest params.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/5.3/search-suggesters-completion.html
     *
     * @return array
     */
    private function addAutocompleteSuggestParams(array $params, array $input, $requestArgs = null)
    {
        $isThisAutosuggest = $requestArgs && is_array($requestArgs) && ($requestArgs['use_suggest_autocomplete_all'] ?? false);

        if ($isThisAutosuggest) {
            $field = 'suggest_autocomplete_all';
        } else {
            $field = 'suggest_autocomplete_boosted';
        }

        $params['body']['suggest']['autocomplete'] = [
            'prefix' => Arr::get($input, 'q'),
            'completion' => [
                'field' => $field,
                'fuzzy' => [
                    'fuzziness' => $this->getFuzzy($input),
                    'min_length' => 5,
                ],
            ],
        ];

        if ($isThisAutosuggest && isset($input['contexts'])) {
            $contexts = $input['contexts'];

            // Ensure that resources is an array, not string
            if (is_string($contexts)) {
                $contexts = explode(',', $contexts);
            }

            $params['body']['suggest']['autocomplete']['completion']['contexts'] = [
                'groupings' => $contexts,
            ];
        }

        return $params;
    }

    /**
     * Append aggregation parameters. This is a straight pass-through for more flexibility.
     * Elasticsearch accepts both `aggs` and `aggregations`, so we support both too.
     *
     * @return array
     */
    public function addAggregationParams(array $params, array $input)
    {
        $aggregations = $input['aggregations'] ?? $input['aggs'] ?? null;

        if ($aggregations) {
            $params['body']['aggregations'] = $aggregations;
        }

        return $params;
    }

    private function getFuzzy(array $input, string $query = null)
    {
        if (count(explode(' ', $query ?? $input['q'] ?? '')) > 7) {
            return 0;
        }

        // Disable fuzzy search on exact match searches
        if (count(explode('"', $query ?? $input['q'] ?? '')) > 1) {
            return 0;
        }

        if (!isset($input['fuzzy'])) {
            return 'AUTO';
        }

        if ($input['fuzzy'] === 'AUTO') {
            return 'AUTO';
        }

        return min([2, (int) $input['fuzzy']]);
    }

    private function getColorParams(array $params, array $input)
    {
        // Exit early if the query is not an exact hex string
        if (!(
            strlen($input['q']) === 7 && preg_match('/^#[0-9a-f]{6}/i', $input['q'])
        ) || (
            strlen($input['q']) === 4 && preg_match('/^#[0-9a-f]{3}/i', $input['q'])
        )) {
            return false;
        }

        $hsl = hexToHsl(substr($input['q'], 1)); // Trim # from start
        $hsl = [
            'h' => $hsl[0] * 360,
            's' => $hsl[1] * 100,
            'l' => $hsl[2] * 100,
        ];

        // Tolerances (+/-) match those used on the website
        $hueTolerance = 22.5; // 1/16 of 360
        $saturationTolerance = 15;
        $lightnessTolerance = 15;

        $hueMin = ($hsl['h'] - $hueTolerance);
        $hueMax = ($hsl['h'] + $hueTolerance);

        $hueQueries = [
            [
                'range' => [
                    'color.h' => [
                        'gte' => max($hueMin, 0),
                        'lte' => min($hueMax, 360),
                    ],
                ],
            ],
        ];

        if ($hueMin < 0) {
            $hueQueries[] = [
                'range' => [
                    'color.h' => [
                        'gte' => $hueMin + 360,
                        'lte' => 360,
                    ],
                ],
            ];
        }

        if ($hueMax > 360) {
            $hueQueries[] = [
                'range' => [
                    'color.h' => [
                        'gte' => 0,
                        'lte' => $hueMax - 360,
                    ],
                ],
            ];
        }

        $params['body']['query']['bool']['must'][] = [
            'bool' => [
                'should' => $hueQueries,
            ],
        ];

        $params['body']['query']['bool']['must'][] = [
            'range' => [
                'color.s' => [
                    'gte' => max($hsl['s'] - $saturationTolerance, 0),
                    'lte' => min($hsl['s'] + $saturationTolerance, 100),
                ],
            ],
        ];

        $params['body']['query']['bool']['must'][] = [
            'range' => [
                'color.l' => [
                    'gte' => max($hsl['l'] - $lightnessTolerance, 0),
                    'lte' => min($hsl['l'] + $lightnessTolerance, 100),
                ],
            ],
        ];

        // We can't do an exists[field]=lqip, b/c lqip isn't indexed
        $params['body']['query']['bool']['must'][] = [
            'exists' => [
                'field' => 'thumbnail.width',
            ],
        ];

        $params['body']['query']['bool']['must'][] = [
            'exists' => [
                'field' => 'thumbnail.height',
            ],
        ];

        return $params;
    }
}
