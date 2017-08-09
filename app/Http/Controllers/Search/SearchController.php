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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->index = env('ELASTICSEARCH_INDEX', 'data_aggregator_test');
    }


    /**
     * General search for keyword or phrase.
     *
     * @return void
     */
    public function search()
    {

        $params = [
            'index' => $this->index,
            'type' => null, // search all types
            // TODO: Consider using json for body for cross-compatibility?
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'multi_match' => [
                                    'query' => Input::get('q', ''),
                                    'fuzziness' => 3,
                                    'prefix_length' => 1,
                                    'fields' => [
                                        '_all',
                                    ]
                                ]
                            ],
                        ],
                        'should' => [
                            [
                                // Boost essential works
                                'terms' => [
                                    'id' => Artwork::getEssentialIds()
                                ]
                            ]
                        ],
                        'filter' => Input::get('filter', null),
                    ]
                ],
                'suggest' => [
                    'text' => Input::get('q', ''),
                    'autocomplete' =>[
                        'prefix' => Input::get('q', ''),
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
                ],
            ],
        ];

        $response = Elasticsearch::search( $params );

        $ret = [];
        $ret = $this->addTotal($ret, $response);
        $ret = $this->addData($ret, $response);
        $ret = $this->addSuggest($ret, $response);

        return $ret;

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

        if ($suggest)
        {

            $ret = array_merge($ret, [
                'suggest' => $suggest]);

        }

        return $ret;

    }

}
