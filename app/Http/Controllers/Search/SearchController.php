<?php

namespace App\Http\Controllers\Search;

use Elasticsearch;
use App\Http\Controllers\Controller;
use App\Http\Search\Request as SearchRequest;
use App\Http\Search\Response as SearchResponse;
use Illuminate\Http\Request;

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
    public function search( Request $request, $type = null )
    {

        return $this->query( $type, 'getSearchParams', 'getSearchResponse' );

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
    public function autocomplete( Request $request, $type = null )
    {

        return $this->query( $type, 'getAutocompleteParams', 'getAutocompleteResponse' );

    }


    /**
     * Helper method to perform a query against Elasticsearch endpoint.
     *
     * @param array $type  Elasticsearch type to query
     * @param string $requestMethod  Name of transformation method on SearchRequest class
     * @param string $responseMethod  Name of transformation method on SearchResponse class
     *
     * @return array
     */
    private function query( $type, $requestMethod, $responseMethod )
    {

        // Transform our API's syntax into an Elasticsearch params array
        $params = ( new SearchRequest( $type ) )->$requestMethod();

        try {
            $results = Elasticsearch::search( $params );
        } catch (\Exception $e) {
            return response( $e->getMessage(), $e->getCode() )->header('Content-Type', 'application/json');
        }

        // Transform Elasticsearch results into our API standard
        $response = ( new SearchResponse( $results, $params ) )->$responseMethod();

        // Prepend the generated query?
        if( $this->showQuery ) {
            $response = array_merge( ["request" => $this->getQuery()], $response );
        }

        return $response;

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
