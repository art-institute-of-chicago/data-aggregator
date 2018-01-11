<?php

namespace App\Http\Controllers\Search;

use App\Http\Search\Request as SearchRequest;
use App\Http\Search\Response as SearchResponse;
use Illuminate\Http\Request;
use Elasticsearch;

use Illuminate\Routing\Controller as BaseController;

class SearchController extends BaseController
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
     * Perform Elasticsearch search, but show last request sent to Elasticsearch instead.
     * Meant for local debugging.
     *
     * @return void
     */
    public function echo( Request $request, $type = null )
    {

        $this->query( $type, 'getSearchParams', 'getSearchResponse' );

        return response( $this->getRequest() )->header('Content-Type', 'application/json');

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

        return $response;

    }


    /**
     * Retrieve the last query sent by this client to Elasticsearch.
     *
     * @return array
     */
    private function getRequest()
    {

        $request = Elasticsearch::connection('default')->transport->lastConnection->getLastRequestInfo()['request'];
        $request['body'] = json_decode( $request['body'], true );

        return $request;

    }

}
