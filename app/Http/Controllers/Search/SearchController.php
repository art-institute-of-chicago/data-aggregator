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
     * Prepend outgoing Elasticsearch query to the response, for debugging.
     *
     * @var boolean
     */
    private $showQuery = false;


    /**
     * General entry point for search. There are three modes:
     *
     *  1. If `query` is present, our client acts as a pass-through.
     *  2. If `query` is absent, check if `q` is present:
     *     a. If `q` is present, fall back into simple search mode.
     *     b. If `q` is absent, show all results.
     *
     * `query` follows ES "Search Request Body" and "Query DSL" conventions.
     * `q` is a string, but it does *not* support ES's "URI Search" syntax.
     *
     * We use `q` for performing simple, opinionated full-text searches, and
     * for offering search suggestions, e.g. spelling corrections.
     *
     * Regardless of whether or not `query` is present, if `q` is present,
     * it will be used to provide "Did You Mean"-style suggestions.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-body.html
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/search-uri-request.html
     *
     * @return void
     */
    public function search($type = null, $input = [])
    {

        $searchRequest = new SearchRequest( $type );

        $params = $searchRequest->getSearchParams($input);

        $results = $this->query( $params );

        $searchResponse = new SearchResponse( $results, $params );

        $response = $searchResponse->getSearchResponse();

        if( $this->showQuery )
        {
            $response = array_merge( ["request" => $this->getQuery()], $response );
        }

        return $response;

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

        $response = $searchResponse->getAutocompleteResponse();

        if( $this->showQuery )
        {
            $response = array_merge( ["request" => $this->getQuery()], $response );
        }

        return $response;

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
     * Retrieve the last query sent by this client to Elasticsearch.
     *
     * @return array
     */
    private function getQuery()
    {

        return json_decode( Elasticsearch::connection('default')->transport->lastConnection->getLastRequestInfo()['request']['body'], true );

    }


    /**
     * Respond with the actual JSON query sent by the official ES PHP client
     *
     * @return string
     */
    private function showQuery()
    {

        return response( $this->getQuery() )->header('Content-Type', 'application/json');

    }

}
