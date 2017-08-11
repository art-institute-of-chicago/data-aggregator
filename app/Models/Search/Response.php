<?php

namespace App\Models\Search;

use Illuminate\Support\Facades\Input;

class Response
{

    public $httpResponse;
    public $simple = true;

    /**
     * Create a new request instance.
     *
     * @return void
     */
    public function __construct(array $httpResponse)
    {
        $this->httpResponse = $httpResponse;
    }

    public function response()
    {

        $response = array_merge([],
                                $this->total(),
                                $this->data());

        if (!$this->simple)
        {

            $response = array_merge($response,
                                    $this->suggest());

        }

        return $response;

    }
    
    public function total()
    {

        return [
            'total' => $this->httpResponse['hits']['total'],
        ];

    }


    public function data()
    {

        // Reduce to just the _source objects
        $hits = $this->httpResponse['hits']['hits'];
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
        $autocompleteOptions = array_get($this->httpResponse, 'suggest.autocomplete.0.options');
        if ($autocompleteOptions) {
            $suggest['autocomplete'] = array_pluck($autocompleteOptions, 'text');
        }

        $phraseOptions = array_get($this->httpResponse, 'suggest.phrase-suggest.0.options');
        if ($phraseOptions) {
            $suggest['phrase'] = array_pluck($phraseOptions, 'highlighted');
        }

        if ($suggest)
        {

            return ['suggest' => $suggest];

        }

        return [];

    }
}
