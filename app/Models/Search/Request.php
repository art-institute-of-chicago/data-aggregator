<?php

namespace App\Models\Search;

use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Input;
use App\Models\Collections\Artwork;

class Request
{


    /**
     * Incoming HTTP request
     *
     * @var HttpRequest
     */
    public $httpRequest;


    /**
     * Submitted input values
     *
     * @var array
     */
    public $input;

    
    /**
     * The name of the index we will be querying.
     *
     * @var string
     */
    protected $index;


    /**
     * Create a new request instance.
     *
     * @return void
     */
    public function __construct(HttpRequest $httpRequest)
    {
        $this->httpRequest = $httpRequest;
        $this->index = env('ELASTICSEARCH_INDEX', 'data_aggregator_test');
    }


    /**
     * List of allowed Input params for querying.
     *
     * @return array
     */
    public function allowed()
    {

        return [

            // TODO: `type` handling

            // Required: we must know the core search string
            // We use `q` b/c it won't cause UnexpectedValueException, if the user uses an official ES Client
            'q',

            // Complex query mode
            'query',
            'sort',

            // Pagination-related stuff
            // TODO: Match Laravel's pagination conventions?
            'from',
            'size',

            // Currently unsupported by the official ES PHP Client
            // 'search_after',

            // Choose which fields to return
            '_source',

            // TODO: Hide implementation by combining _source w/ other fields?
            // Note that _source supports wildcards, while the others do not
            // 'fields', // old convention
            // 'stored_fields',
            // 'docvalue_fields',

        ];

    }


    /**
     * The type of Elasticsearch search
     *
     * @return string
     */
    public function type() {

        if ($this->httpRequest->segment(3) != 'search')
        {

            return $httpRequest->segment(3);

        }

        return null;

    }


    /**
     * Strip down the (top-level) params to what our thin client supports.
     *
     * @param array  All user input (query string params or json). I.e., Input::all()
     * @return array  Parsed out input values
     */
    public function validInput() {

        if (!$this->input)
        {

            $input = Input::all();

            // List of allowed user-specified params
            $allowed = $this->allowed();

            // `null` will be the default value for all params
            $defaults = array_fill_keys( $allowed, null );

            // Reduce the input set to the params we allow
            $input = array_intersect_key($input, array_flip( $allowed ) );

            // Combine $defaults and $input: we won't have to use is_set, only is_null
            $input = array_merge( $defaults, $input );

            $this->input = $input;

        }

        return $this->input;

    }


    /**
     * Build the basic scaffolding used by all ES queries.
     *
     * @return array  An Elasticsearch query params array
     */
    public function params() {

        $input = $this->validInput();

        $params = [

            'index' => $this->index,
            'type' => $this->type(),

            'from' => $input['from'],
            'size' => $input['size'],

            // TODO: Re-enable this once the official ES PHP Client supports it
            // 'search_after' => $input['search_after'],

            'body' => [

                'query' => [
                    'bool' => [
                        'must' => [], // user-specified queries go here
                        'should' => [], // our custom boosting queries go here
                    ]
                ],

            ],

        ];

        if( is_null( $input['q'] ) ) {
            
            // Empy search requires special handling, e.g. no suggestions
            $params = $this->getEmptySearchParams( $params );

        } else {

            if( is_null( $input['query'] ) ) {

                $params = $this->getSimpleSearchParams( $params, $input );

            } else {

                $params = $this->getFullSearchParams( $params, $input );

            }

            // Both `query` and `q`-only searches support suggestions
            $params = $this->getSuggestSearchParams( $params, $input );

        }

        // Boost essential works
        // TODO: Move this to separate function once additional boosts are required
        $params['body']['query']['bool']['should'][] = [
            'terms' => [
                'id' => Artwork::getEssentialIds()
            ]
        ];

        return $params;

    }


    /**
     * Get the search params for an empty string search
     *
     * @return array  An Elasticsearch query params array
     */
    private function getEmptySearchParams( $params ) {

        // PHP JSON-encodes empty array as [], not {}
        $params['body']['query']['bool']['must'][] = [
            'match_all' => new \stdClass()
        ];

        return $params;

    }


    /**
     * Get the search params for a simple search
     *
     * @return array  An Elasticsearch query params array
     */
    private function getSimpleSearchParams( $params, $input ) {

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
    private function getFullSearchParams( $params, $input ) {

        // TODO: Validate `query` input to reduce shenanigans
        $params['body']['query']['bool']['must'][] = $input['query'];

        // TODO: Deep-find `fields` in certain queries + replace them w/ our custom field list

        return $params;

    }


    /**
     * Get the suggest params for a search query
     *
     * @return array  An Elasticsearch suggest params array
     */
    private function getSuggestSearchParams( $params, $input ) {

        $params['body']['suggest'] = [

            'text' => $input['q'],

            'autocomplete' =>[
                'prefix' =>  $input['q'],
                'completion' => [
                    'field' => 'suggest_autocomplete',
                ],
            ],

            // This is currently not working
            'phrase-suggest' => [
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
            ],

        ];

        return $params;

    }

}
