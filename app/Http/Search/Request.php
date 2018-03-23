<?php

namespace App\Http\Search;

use Illuminate\Support\Facades\Input;

class Request
{

    /**
     * The API resource through which search was accessed.
     *
     * @var string
     */
    protected $resource = null;

    /**
     * Identifier, e.g. for `_explain` queries
     *
     * @var string
     */
    protected $id = null;

    /**
     * Array of queries needed to isolate any "scoped" resources in this request.
     *
     * @var array
     */
    protected $scopes = null;

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

        // Fields to use for aggregations
        'aggs',
        'aggregations',

        // Determines which shards to use, ensures consistent result order
        'preference',

    ];

    /**
     * Default fields to return.
     *
     * @var array
     */
    private static $defaultFields = [
        'id',
        'api_id',
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
    private static $maxSize = 1000;


    /**
     * Create a new request instance.
     *
     * @param $resource string
     *
     * @return void
     */
    public function __construct( $resource = null, $id = null )
    {
        $this->resource = $resource;
        $this->id = $id;
    }


    /**
     * Get params that should be applied to all queries.
     *
     * @TODO: Remove type-related logic when we upgrade to ES 6.0
     *
     * @return array
     */
    public function getBaseParams( array $input ) {

        // Grab resource target from resource endpoint or `resources` param
        $resources = $this->resource ?? $input['resources'] ?? null;

        if( is_null( $resources ) )
        {

            $indexes = env('ELASTICSEARCH_ALIAS');

        } else {

            // Ensure that resources is an array, not string
            if( !is_array( $resources ) )
            {
                $resources = explode(',', $resources);
            }

            // Filter out any resources that have a parent resource requested as well
            // So e.g. if places and galleries are requested, we'll show places only
            $resources = array_filter( $resources, function($resource) use ($resources) {

                $parent = app('Resources')->getParent( $resource );

                return !in_array( $parent, $resources );

            });

            // Grab settings from our models via the service provider
            $settings = array_map( function($resource) {

                return app('Search')->getSearchScopeForEndpoint( $resource );

            }, $resources);

            // Make settings into a Laravel collection
            $settings = collect($settings);

            // Collate our indexes and types
            $indexes = $settings->pluck('index')->unique()->all();
            $types = $settings->pluck('type')->unique()->all();

            // These will be injected into the must clause
            $this->scopes = $settings->pluck('scope')->filter()->all();

            // Looks like we don't need to implode $indexes and $types
            // PHP Elasticsearch seems to do so for us

        }

        return [
            'index' => $indexes,
            'type' => $types ?? null,
            'preference' => array_get( $input, 'preference' ),
        ];

    }


    /**
     * Build full param set (request body) for autocomplete queries.
     *
     * @return array
     */
    public function getAutocompleteParams( ) {

        // Strip down the (top-level) params to what our thin client supports
        $input = self::getValidInput();

        // TODO: Handle case where no `q` param is present?
        if( is_null( array_get( $input, 'q' ) ) ) {
            return [];
        }

        // Hardcode $input to only return the fields we want
        $input['fields'] = [
            'title'
        ];

        // Suggest also returns `_source`, which we can parse to get the cannonical title
        $params = array_merge(
            $this->getBaseParams( $input ) ,
            $this->getFieldParams( $input, false )
        );

        // `q` is required here, but we won't send an actual `query`
        $params = $this->addSuggestParams( $params, $input );

        return $params;

    }


    /**
     * Build full param set (request body) for search queries.
     *
     * @return array
     */
    public function getSearchParams( $input = null, $withSuggestions = true, $withAggregations = true ) {

        // Strip down the (top-level) params to what our thin client supports
        $input = self::getValidInput( $input );

        $params = array_merge(
            $this->getBaseParams( $input ),
            $this->getFieldParams( $input ),
            $this->getPaginationParams( $input )
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
        $params = $this->addSortParams( $params, $input );

        // Add our custom relevancy tweaks into `should`
        $params = $this->addRelevancyParams( $params, $input );

        // Add params to isolate "scoped" resources into `must`
        $params = $this->addScopeParams( $params, $input );

        /**
         * 1. If `query` is present, append it to the `must` clause.
         * 2. If `q` is present, add full-text search to the `must` clause.
         * 3. If `q` is absent, show all results.
         */
        if( isset( $input['query'] ) ) {

            $params = $this->addFullSearchParams( $params, $input );

        }

        if( isset( $input['q'] ) ) {

            $params = $this->addSimpleSearchParams( $params, $input );

        } else {

            $params = $this->addEmptySearchParams( $params );

        }

        // If `q` is present, use it for search suggestions
        if( isset( $input['q'] ) && $withSuggestions ) {

            $params = $this->addSuggestParams( $params, $input );

        }

        // Add Aggregations (facets)
        if( $withAggregations ) {

            $params = $this->addAggregationParams( $params, $input );

        }

        return $params;

    }


    /**
     * Gather params for an expalin query. Explain queries are identical to search,
     * but they need an id and lack pagination, aggregations, and suggestions.
     *
     * @return array
     */
    public function getExplainParams( $input = [] ) {

        $params = $this->getSearchParams( $input, false, false );

        $params['id'] = $this->id;

        unset( $params['from'] );
        unset( $params['size'] );

        return $params;

    }


    /**
     * Strip down the (top-level) user-input to what our thin client supports.
     * Allowed-but-omitted params are added as `null`
     *
     * @param $input array
     *
     * @return array
     */
    public static function getValidInput( array $input = null ) {

        // Grab all user input (query string params or json)
        $input = $input ?: Input::all();

        // List of allowed user-specified params
        $allowed = self::$allowed;

        // `null` will be the default value for all params
        $defaults = array_fill_keys( $allowed, null );

        // Reduce the input set to the params we allow
        $input = array_intersect_key( $input, array_flip( $allowed ) );

        // Combine $defaults and $input: we won't have to use is_set, only is_null
        $input = array_merge( $defaults, $input );

        return $input;

    }


    /**
     * Get pagination params.
     *
     * @param $input array
     *
     * @return array
     */
    private function getPaginationParams( array $input ) {

        // Elasticsearch params take precedence
        // If that doesn't work, attempt to convert Laravel's pagination into ES params
        $size = $input['size'] ?? $input['limit'] ?? null;
        $from = $input['from'] ?? $input['page'] ??  null;

        // ES is robust: it can accept `size` or `from` independently

        // If not null, cast these params to int
        // We are using isset() instead of normal ternary to avoid catching `0` as falsey
        if( isset( $size ) ) { $size = (int) $size; }
        if( isset( $from ) ) { $from = (int) $from; }

        // TODO: Throw an exception if `size` is too big
        // This will have to wait until we refactor controller exceptions
        if( $size > self::$maxSize ) {
            //
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
     * @param $input array
     * @param $default mixed Valid `_source` is array, string, null, or bool
     *
     * @return array
     */
    private function getFieldParams( array $input, $default = null ) {

        return [
            '_source' => $input['fields'] ?? ( $default ?? self::$defaultFields ),
        ];

    }


    /**
     * Determine sort order. Sort must go into the request body, and it cannot be null.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/5.3/search-request-sort.html
     * @link https://github.com/elastic/elasticsearch-php/issues/179
     *
     * @param $params array
     * @param $input array
     *
     * @return array
     */
    private function addSortParams( array $params, array $input ) {

        if( isset( $input['sort'] ) )
        {
            $params['body']['sort'] = $input['sort'];
        }

        return $params;

    }


    /**
     * Append our own custom queries to tweak relevancy.
     *
     * @param $params array
     * @param $input array
     *
     * @return array
     */
    public function addRelevancyParams( array $params, array $input )
    {

        // Don't tweak relevancy if sort is passed
        if( isset( $input['sort'] ) )
        {
            return $params;
        }

        // Boost anything with `is_boosted` true
        $params['body']['query']['bool']['should'][] = [
            'term' => [
                'is_boosted' => true
            ]
        ];

        // Boost anything that's on view
        // TODO: Move this to the Artwork model?
        // TODO: Only do this when artworks are searched?
        $params['body']['query']['bool']['should'][] = [
            'term' => [
                'is_on_view' => true
            ]
        ];

        return $params;

    }


    /**
     * Append any search clauses that are needed to isolate scoped resources.
     *
     * @param $params array
     * @param $input array
     *
     * @return array
     */
    public function addScopeParams( array $params, array $input )
    {

        // Assumes that `scopes` has no null members
        $params['body']['query']['bool']['must'][] = [
            'bool' => [
                'should' => $this->scopes,
            ]
        ];

        return $params;

    }


    /**
     * Get the search params for an empty string search.
     * Empy search requires special handling, e.g. no suggestions.
     *
     * @param $params array
     *
     * @return array
     */
    private function addEmptySearchParams( array $params ) {

        // PHP JSON-encodes empty array as [], not {}
        $params['body']['query']['bool']['must'][] = [
            'match_all' => new \stdClass()
        ];

        return $params;

    }


    /**
     * Append the query params for a simple search
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/5.3/common-options.html#fuzziness
     *
     * @param $params array
     * @param $input array
     *
     * @return array
     */
    private function addSimpleSearchParams( array $params, array $input ) {

        // TODO: Determine if defaults for `fuzziness` and `prefix_length` are sufficient
        // https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-fuzzy-query.htm

        // TODO: Determine which fields to query w/ is_numeric()?
        // See also `lenient` param

        // Pull all docs that match fuzzily into the results
        $params['body']['query']['bool']['must'][] = [
            'multi_match' => [
                'query' => array_get( $input, 'q' ),
                'fuzziness' => 'AUTO',
                'prefix_length' => 1,
                'fields' => app('Search')->getDefaultFields()
            ]
        ];

        // Queries below depend on `q`, but act as relevany tweaks
        // Don't tweak relevancy further if sort is passed
        if( isset( $input['sort'] ) )
        {
            return $params;
        }

        // This acts as a boost for docs that match precisely
        $params['body']['query']['bool']['should'][] = [
            'multi_match' => [
                'query' => array_get( $input, 'q' ),
                'fields' => app('Search')->getDefaultFields()
            ]
        ];

        // This boosts docs that have multiple terms in close proximity
        // `phrase` queries are relatively expensive, so check for spaces first
        // https://www.elastic.co/guide/en/elasticsearch/guide/current/_improving_performance.html
        if( strpos( $input['q'], ' ' ) )
        {
            $params['body']['query']['bool']['should'][] = [
                'multi_match' => [
                    'query' => array_get( $input, 'q' ),
                    'type' => 'phrase',
                    'slop' => 3, // account for e.g. middle names
                    'fields' => app('Search')->getDefaultFields()
                ]
            ];
        }

        return $params;

    }


    /**
     * Get the search params for a complex search
     *
     * @param $params array
     * @param $input array
     *
     * @return array
     */
    private function addFullSearchParams( array $params, array $input ) {

        // TODO: Validate `query` input to reduce shenanigans
        // TODO: Deep-find `fields` in certain queries + replace them w/ our custom field list
        $params['body']['query']['bool']['must'][] = [
            array_get( $input, 'query' ),
        ];

        return $params;

    }


    /**
     * Append suggest params to query.
     *
     * Both `query` and `q`-only searches support suggestions.
     * Empty searches do not support suggestions.
     *
     * @param $params array
     * @param $input array
     *
     * @return array
     */
    public function addSuggestParams( array $params, array $input )
    {

        $params['body']['suggest'] = [
            'text' => array_get( $input, 'q' ),
        ];

        $params = $this->addAutocompleteSuggestParams( $params, $input );

        return $params;

    }


    /**
     * Append autocomplete suggest params.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/5.3/search-suggesters-completion.html
     *
     * @param $params array
     * @param $input array
     *
     * @return array
     */
    private function addAutocompleteSuggestParams( array $params, array $input)
    {

        $params['body']['suggest']['autocomplete'] = [
            'prefix' =>  array_get( $input, 'q' ),
            'completion' => [
                'field' => 'suggest_autocomplete_boosted',
                'fuzzy' => [
                    'fuzziness' => 'AUTO',
                    'min_length' => 5,
                ]
            ],
        ];

        return $params;

    }


    /**
     * Append aggregation parameters. This is a straight pass-through for more flexibility.
     * Elasticsearch accepts both `aggs` and `aggregations`, so we support both too.
     *
     * @param $params array
     * @param $input array
     *
     * @return array
     */
    public function addAggregationParams( array $params, array $input )
    {

        $aggregations = $input['aggregations'] ?? $input['aggs'] ?? null;

        if( $aggregations ) {

            $params['body']['aggregations'] = $aggregations;

        }

        return $params;

    }


}
