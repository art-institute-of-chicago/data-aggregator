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
        $this->index = env('ELASTICSEARCH_INDEX', 'data_aggregator:v1');
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
                        'should' => [
                            [
                                'match' => [
                                    // TODO: Target specific fields, not _all
                                    '_all' => [
                                        'query' => Input::get('q', '')
                                    ]
                                ]
                            ],
                            [
                                // Boost essential works
                                'terms' => [
                                    'id' => Artwork::getEssentialIds()
                                ]
                            ]
                        ]
                    ]
                ]
            ]

        ];

        return Elasticsearch::search( $params );

    }


}
