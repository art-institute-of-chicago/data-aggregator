<?php

namespace App\Http\Search;

use Illuminate\Support\Facades\Input;

class Response
{

    public $searchResponse;

    public $searchParams;

    /**
     * Create a new request instance.
     *
     * @param array $searchResponse Response as it came back from Elasitcsearch
     * @param array $searchParams Params passed to Elasticsearch
     *
     * @return void
     */
    public function __construct(array $searchResponse, array $searchParams)
    {
        $this->searchResponse = $searchResponse;
        $this->searchParams = $searchParams;
    }


    public function response()
    {

        $response = array_merge(
            $this->paginate(),
            $this->data()
        );

        $response = array_merge(
            $response,
            $this->suggest()
        );

        $response = array_merge(
            $response,
            $this->aggregate()
        );

        $response = array_merge(
            [
                'preference' => $this->searchParams['preference'],
            ],
            $response
        );

        return $response;

    }


    public function paginate()
    {

        // LengthAwarePaginator has trouble here
        $total = $this->searchResponse['hits']['total'];
        $limit = $this->searchParams['size'] ?: 10;
        $offset = $this->searchParams['from'] ?: 0;

        $total_pages = ceil( $total / $limit );
        $current_page = floor( $offset / $limit ) + 1;

        $pagination = [
            'total' => $total,
            'limit' => $limit,
            'offset' => $offset,
            'total_pages' => $total_pages,
            'current_page' => $current_page,
        ];

        return [
            'pagination' => $pagination
        ];

    }


    public function data()
    {

        $hits = $this->searchResponse['hits']['hits'];
        $results = [];

        // Reduce to just the _source objects
        foreach( $hits as $hit ) {

            $result = [
                '_score' => $hit['_score']
            ];

            // Avoid filtering fields here: filter fields via `_source` in Request instead
            // This will reduce AWS ES load - it won't need to return as much data
            // Note that `_source` might be undefined if `_source` was set to false in Request
            if( isset( $hit['_source'] ) ) {
                $result = array_merge( $result, $hit['_source'] );
            }

            $results[] = $result;

        }

        return [
            'data' => $results
        ];

    }


    public function suggest()
    {

        $suggest = [];

        $options = array_get($this->searchResponse, 'suggest.autocomplete.0.options');

        if ($options) {
            $suggest['autocomplete'] = array_pluck($options, 'text');
        }

        $options = array_get($this->searchResponse, 'suggest.phrase-suggest.0.options');

        if ($options) {
            $suggest['phrase'] = array_pluck($options, 'highlighted');
        }

        if ($suggest)
        {

            return ['suggest' => $suggest];

        }

        return [];

    }


    public function aggregate()
    {

        $results = array_get($this->searchResponse, 'aggregations');

        // Exit out of there are no aggregations returned
        if( is_null( $results ) ) {
            return [];
        }

        $aggs = [];

        foreach ( $results as $count => $data)
        {

            $aggs[$count] = $data['buckets'];

        }

        if ($aggs)
        {

            return ['aggregations' => $aggs];

        }

        return [];

    }

}
