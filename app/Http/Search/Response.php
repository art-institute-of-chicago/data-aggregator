<?php

namespace App\Http\Search;

use Illuminate\Support\Facades\Input;

class Response
{

    public $searchResponse;

    /**
     * Create a new request instance.
     *
     * @return void
     */
    public function __construct(array $searchResponse)
    {
        $this->searchResponse = $searchResponse;
    }

    public function response()
    {

        $response = array_merge(
            $this->total(),
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

        return $response;

    }

    public function total()
    {

        return [
            'total' => $this->searchResponse['hits']['total'],
        ];

    }


    public function data()
    {

        // Reduce to just the _source objects
        $hits = $this->searchResponse['hits']['hits'];
        $results = [];

        foreach( $hits as $hit ) {
            $results[] = [
                '_score' => $hit['_score'],
                'id' => $hit['_source']['id'],
                'api_id' => $hit['_source']['api_id'],
                'api_model' =>$hit['_source']['api_model'],
                'api_link' => $hit['_source']['api_link'],
                'title' => $hit['_source']['title'],
                'timestamp' => $hit['_source']['timestamp'],
            ];

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

        $aggs = [];

        foreach (array_get($this->searchResponse, 'aggregations') as $count => $data)
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
