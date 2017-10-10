<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Http\Search\Request as SearchRequest;
use App\Http\Search\Response as SearchResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request as HttpRequest;
use Elasticsearch;

class SearchController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Search Controller
    |--------------------------------------------------------------------------
    |
    | This controller provides a thin API on top of Elasticsearch. It largely
    | follows ES Request Body conventions, but limits what kind of queries can
    | be performed, for security and performance reasons. Additionally, it
    | applies our own business logic to tweak relevancy.
    |
    */


    /**
     * General entry point for search. There are three modes:
     *
     * 1. Don't pass `q` to view all works, magically sorted.
     * 2. Pass `q` param w/ string for a simple, optimized search.
     * 3. Pass `q` param *and* `query` param, which follows ES Request Body conventions.
     *
     * The most important distinction is between "empty" and "non-empty" queries.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-body.html
     *
     * @return void
     */
    public function search($type = null, $input = [])
    {

        $searchRequest = new SearchRequest( $type );

        $params = $searchRequest->getSearchParams($input);

        $results = $this->query( $params );

        $searchResponse = new SearchResponse( $results, $params );

        return $searchResponse->getSearchResponse();

    }


    /**
     * Return only the `suggest` field of search. This method optimizes both our request
     * to Elasticsearch and the outgoing results for the minimum required to provide
     * autocomplete suggestions. It accepts the same params as the `search` method,
     * though most of them will not be used.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/search-suggesters-completion.html
     *
     * @return void
     */
    public function autocomplete($type = null)
    {

        $searchRequest = new SearchRequest( $type );

        $params = $searchRequest->getAutocompleteParams();

        $results = $this->query( $params );

        $searchResponse = new SearchResponse( $results, $params );

        return $searchResponse->getAutocompleteResponse();

    }


    /**
     * Perform a query against Elasticsearch endpoint
     *
     * @param array $params
     *
     * @return array
     */
    private function query( array $params )
    {

        try {

            $searchResponse = Elasticsearch::search( $params );

        } catch (\Exception $e) {

            return response( $e->getMessage(), $e->getCode() )->header('Content-Type', 'application/json');

        }

        return $searchResponse;

    }


    /**
     * Respond with the actual JSON query sent by the official ES PHP client
     *
     * @return string
     */
    private function showQuery()
    {

        return response( Elasticsearch::connection('default')->transport->lastConnection->getLastRequestInfo()['request']['body'] )->header('Content-Type', 'application/json');

    }

}
