<?php

namespace App\Http\Search;

use Illuminate\Support\Facades\Input;
use App\Models\Collections\Artwork;

class Request
{

    /**
     * The name of the index we will be querying.
     *
     * @var string
     */
    protected $index;

    /**
     * The Elasticsearch type (model) we will be querying.
     *
     * @var string
     */
    protected $type = null;

    /**
     * List of allowed Input params for querying.
     *
     * @var array
     */
    private static $allowed = [

        // Type can be passed via route, or via query params
        'type',

        // Required: we must know the core search string
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
        '_source',

        // Fields to use for aggregations
        'facets',

        // TODO: Hide implementation by combining _source w/ other fields?
        // Note that _source supports wildcards, while the others do not
        // 'fields', // old convention
        // 'stored_fields',
        // 'docvalue_fields',

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
        'title',
        'timestamp',
    ];


    /**
     * Create a new request instance.
     *
     * @return void
     */
    public function __construct( $type = null )
    {
        $this->index = env('ELASTICSEARCH_INDEX', 'data_aggregator_test');
        $this->type = $type;
    }


    /**
     * These params will be applied to all queries.
     *
     * @return array
     */
    public function getBaseParams( $input ) {

        return [
            'index' => $this->index,
            'type' => $input['type'] ?: $this->type,
            'preference' => $input['preference'],
        ];

    }


    /**
     * Build the basic scaffolding used by all ES queries.
     *
     * @return array
     */
    public function getAutocompleteParams( ) {

        // Strip down the (top-level) params to what our thin client supports
        $input = self::getValidInput();

        // TODO: Handle case where no `q` param is present?
        if( is_null( $input['q'] ) ) {
            return [];
        }

        // Suggest also returns `_source`, which we can disable to reduce server load
        $params = array_merge(
            $this->getBaseParams( $input ) ,
            $this->getFieldParams( $input, false )
        );

        // `q` is required here, but we won't send an actual `query`
        $params = $this->addSuggestParams( $params, $input );

        return $params;

    }


    /**
     * Build the basic scaffolding used by all ES queries.
     *
     * @return array
     */
    public function getSearchParams(  ) {

        // Strip down the (top-level) params to what our thin client supports
        $input = self::getValidInput();

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


        if( is_null( $input['q'] ) ) {

            // Empy search requires special handling, e.g. no suggestions
            $params = $this->addEmptySearchParams( $params );

        } else {

            if( is_null( $input['query'] ) ) {

                $params = $this->addSimpleSearchParams( $params, $input );

            } else {

                $params = $this->addFullSearchParams( $params, $input );

            }

            // Both `query` and `q`-only searches support suggestions
            $params = $this->addSuggestParams( $params, $input );

        }

        // Add Aggregations (facets)
        $params = $this->addAggregationParams( $params, $input );


        return $params;

    }


    /**
     * Strip down the (top-level) params to what our thin client supports.
     *
     * Allowed-but-omitted params are added as `null`
     *
     * @return array  Parsed out input values
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


    private function getPaginationParams( $input ) {

        // Elasticsearch params take precedence
        $size = isset( $input['size'] ) ? $input['size'] : null;
        $from = isset( $input['from'] ) ? $input['from'] : null;

        // If that doesn't work, attempt to convert Laravel's pagination into ES params
        isset( $size ) ?: $size = isset( $input['limit'] ) ? $input['size'] : null;
        isset( $from ) ?: $from = isset( $input['page'] ) ? $input['page'] * $size : null;

        // If not null, cast these params to int
        if( isset( $size ) ) { $size = (int) $size; }
        if( isset( $from ) ) { $from = (int) $from; }

        // We are using isset() instead of normal ternary to avoid catching `0` as falsey
        // PHP 7 allows the "null coalescing operator"  - `??` - which serves the same role
        // https://stackoverflow.com/questions/18603250/php-shorthand-for-isset

        return [

            // TODO: Determine if this interferes w/ an autocomplete-only search
            'from' => $from,
            'size' => $size,

            // TODO: Re-enable this once the official ES PHP Client supports it
            // 'search_after' => $input['search_after'],

        ];

    }


    /**
     * Determine which fields to return. Set `_source` to `true` to return all.
     *
     * @return array  An Elasticsearch query params array
     */
    private function getFieldParams( $input, $default = null ) {

        return [
            // '_source' => $input['_source'] ?? ( $default ?? self::$defaultFields ), // PHP 7
            '_source' => isset( $input['_source'] ) ? $input['_source'] : ( isset( $default ) ? $default : self::$defaultFields ),
        ];

    }


    /**
     * Get the search params for an empty string search.
     * Empy search requires special handling, e.g. no suggestions.
     *
     * @return array  An Elasticsearch query params array
     */
    private function addEmptySearchParams( $params ) {

        // PHP JSON-encodes empty array as [], not {}
        $params['body']['query']['bool']['must'][] = [
            'match_all' => new \stdClass()
        ];

        return $params;

    }


    /**
     * Append the search params for a simple search
     *
     * @return array  An Elasticsearch query params array
     */
    private function addSimpleSearchParams( $params, $input ) {

        // TODO: Determine if defaults for `fuzziness` and `prefix_length` are sufficient
        // https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-fuzzy-query.htm

        // TODO: Determine which fields to query w/ is_numeric()?
        // See also `lenient` param

        $params['body']['query']['bool']['must'][] = [
            'multi_match' => [
                'query' => $input['q'],
                'fuzziness' => 3,
                'prefix_length' => 1,
                'fields' => [
                    '_all',
                ]
            ]
        ];

        return $params;

    }


    /**
     * Get the search params for a complex search
     *
     * @return array  An Elasticsearch query params array
     */
    private function addFullSearchParams( $params, $input ) {

        // TODO: Validate `query` input to reduce shenanigans
        // TODO: Deep-find `fields` in certain queries + replace them w/ our custom field list
        $params['body']['query']['bool']['must'][] = [
            $input['query'],
        ];

        return $params;

    }


    /**
     * Boost essential works
     *
     * @param $input array Parsed out user input
     * @return array  An Elasticsearch should query params array
     */
    public function addRelevancyParams( array $input )
    {

        $params['body']['query']['bool']['should'][] = [
            'terms' => [
                'id' => Artwork::getEssentialIds()
            ]
        ];

        return $params;

    }


    /**
     * Construct suggest parameters.
     *
     * Both `query` and `q`-only searches support suggestions.
     * Empty searches do not support suggestions.
     *
     * @param $input array Parsed out user input
     * @return array  An Elasticsearch suggest params array
     */
    public function addSuggestParams( array $params, array $input )
    {

        $params['body']['suggest'] = [
            'text' => $input['q'],
        ];

        $params = $this->addAutocompleteSuggestParams( $params, $input );
        $params = $this->addPhraseSuggestParams( $params, $input );

        return $params;

    }


    /**
     * Get the autocomplete suggest params
     *
     * @return array  One element of an Elasticsearch suggest params array
     */
    private function addAutocompleteSuggestParams( $params, array $input)
    {

        $params['body']['suggest']['autocomplete'] = [
            'prefix' =>  $input['q'],
            'completion' => [
                'field' => 'suggest_autocomplete',
            ],
        ];

        return $params;

    }


    /**
     * Get the phrase suggest params
     *
     * @return array  One element of an Elasticsearch suggest params array
     */
    private function addPhraseSuggestParams( $params )
    {

        $params['body']['suggest']['phrase-suggest'] = [
            'phrase' => [
                'field' => 'suggest_phrase.trigram',
                'gram_size' => 3,
                'direct_generator' => [
                    [
                        'field' => 'suggest_phrase.trigram',
                        'suggest_mode' => 'always'
                    ],
                    [
                        'field' => 'suggest_phrase.reverse',
                        'suggest_mode' => 'always',
                        'pre_filter' => 'reverse',
                        'post_filter' => 'reverse'
                    ],
                ],
                'highlight' => [
                    'pre_tag' => '<em>',
                    'post_tag' => '</em>'
                ],
            ],
        ];

        return $params;

    }


    /**
     * Construct aggregation parameters.
     *
     * @return array  An Elasticsearch aggregations params array
     */
    public function addAggregationParams( $params, array $input )
    {

        // If the user did not specify a facet parameter, facet by model
        $facets = $input['facets'] ? explode(',', $input['facets']) : ['api_model'];

        $aggregations = [];

        foreach ($facets as $facet)
        {

            $aggregations['count_' . $facet] = [
                'terms' => [
                    'field' => $facet
                ]
            ];

        }

        // Official ES PHP Client is behind the times
        // https://www.elastic.co/guide/en/elasticsearch/client/php-api/current/_per_request_configuration.html#_providing_custom_query_parameters
        // $params['client']['custom']['aggregations'] = $aggregations;

        $params['body']['aggregations'] = $aggregations;

        return $params;

    }


}
