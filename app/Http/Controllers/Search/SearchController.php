<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Models\Collections\Artwork;
use Illuminate\Support\Facades\Input;
use Elasticsearch;

class SearchController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Search Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */


    /**
     * The name of the index we will be querying.
     *
     * @var string
     */
    protected $index;


    /**
     * List of allowed Input params for querying.
     *
     * @var array
     */
    private $allowed = [

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


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->index = env('ELASTICSEARCH_INDEX', 'data_aggregator_test');
    }


    /**
     * General entry point for search. There are three modes:
     *
     * 1. Don't pass any params to view all works, magically sorted.
     * 2. Pass `q` param w/ string for a simple, optimized search.
     * 3. Pass `q` param *and* subset of ES Request Body params.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-body.html
     *
     * @return void
     */
    public function search()
    {

        // Strip down the (top-level) params to what our thin client supports
        $input = $this->getValidInput();

        // Build the basic scaffolding used by all ES queries
        $params = [

            'index' => $this->index,
            'type' => null, // search all types

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

        // Keeping this here for debug purposes:
        // return response()->json( $params );

        try {
            $response = Elasticsearch::search( $params );
        } catch (\Exception $e) {
            return response( $e->getMessage(), $e->getCode() )->header('Content-Type', 'application/json');
        }

        // This is the actual query sent by the official ES PHP client
        // return response()->json( json_decode( Elasticsearch::connection('default')->transport->lastConnection->getLastRequestInfo()['request']['body'] ) );

        $ret = [];
        $ret = $this->addTotal($ret, $response);
        $ret = $this->addData($ret, $response);

        if( !is_null( $input['q'] ) ) {
            $ret = $this->addSuggest($ret, $response);
        }

        return $ret;

    }


    private function getValidInput( ) {

        // List of allowed user-specified params
        $allowed = $this->allowed;

        // `null` will be the default value for all params
        $defaults = array_fill_keys( $allowed, null );

        // Grab all user input (query string params or json)
        $input = Input::all();

        // Reduce the input set to the params we allow
        $input = array_intersect_key($input, array_flip( $allowed ) );

        // Combine $defaults and $input: we won't have to use is_set, only is_null
        $input = array_merge( $defaults, $input );

        return $input;

    }


    private function getEmptySearchParams( $params ) {

        // PHP JSON-encodes empty array as [], not {}
        $params['body']['query']['bool']['must'][] = [
            'match_all' => new \stdClass()
        ];

        return $params;

    }


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


    private function getFullSearchParams( $params, $input ) {

        // TODO: Validate `query` input to reduce shenanigans
        $params['body']['query']['bool']['must'][] = $input['query'];

        // TODO: Deep-find `fields` in certain queries + replace them w/ our custom field list

        return $params;

    }


    private function getSuggestSearchParams( $params, $input ) {

        $params['body']['suggest'] = [

            'text' => $input['q'],

            'autocomplete' =>[
                'prefix' =>  $input['q'],
                'completion' => [
                    'field' => 'suggest',
                ],
            ],

            // This is currently not working
            'phrase-suggest' => [
                'phrase' => [
                    'field' => 'title.trigram',
                    'gram_size' => 3,
                    'direct_generator' => [
                        [
                            'field' => 'title.trigram',
                            'suggest_mode' => 'always'
                        ],
                        [
                            'field' => 'title.reverse',
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

            // This works, but is not very usable for API consumers
            'term-suggest' => [
                'term' => [
                    'field' => 'title'
                ],
            ],

        ];

        return $params;

    }


    private function addTotal($ret, $response)
    {

        return array_merge($ret,
                           [
                               'total' => $response['hits']['total'],
                           ]);

    }


    private function addData($ret, $response)
    {

        // Reduce to just the _source objects
        $hits = $response['hits']['hits'];
        $results = [];

        foreach( $hits as $hit ) {
            $results[] = array_merge(
                [
                    '_score' => $hit['_score'],
                ],
                $hit['_source']
            );
        }

        return array_merge($ret,
                           [
                               'data' => $results
                           ]);

    }


    private function addSuggest($ret, $response)
    {

        $suggest = [];
        $autocompleteOptions = array_get($response, 'suggest.autocomplete.0.options');
        if ($autocompleteOptions) {
            $suggest['autocomplete'] = array_pluck($autocompleteOptions, 'text');
        }

        $phraseOptions = array_get($response, 'suggest.phrase-suggest.0.options');
        if ($phraseOptions) {
            $suggest['phrase'] = array_pluck($phraseOptions, 'highlighted');
        }

        if ($suggest)
        {

            $ret = array_merge($ret, [
                'suggest' => $suggest]);

        }

        return $ret;

    }

}
