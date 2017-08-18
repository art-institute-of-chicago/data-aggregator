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
    | This controller provides a thin API on top of Elasticsearch. It follows ES
    | conventions, but limits what kind of queries can be performed, for
    | security and performance reasons. Additionally, it applies our own
    | business logic to tweak relevancy.
    |
    */


    /**
     * General entry point for search. There are three modes:
     *
     * 1. Don't pass any params to view all works, magically sorted.
     * 2. Pass `q` param w/ string for a simple, optimized search.
     * 3. Pass `q` param *and* subset of ES Request Body params.
     *
     * The most important distinction is between "empty" and "non-empty" queries.
     *
     * Autocomplete uses this method as well.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-body.html
     *
     * @return void
     */
    public function search(HttpRequest $httpRequest)
    {

        $searchRequest = new SearchRequest( $httpRequest );

        $params = $searchRequest->getSearchParams();

        try {

            $searchResponse = Elasticsearch::search( $params );

        } catch (\Exception $e) {

            return response( $e->getMessage(), $e->getCode() )->header('Content-Type', 'application/json');

        }

        return $this->response($searchResponse);

    }


    /**
     * Perform the search against ES endpoint
     *
     * @param HttpRequest  The incoming request to this controller
     * @return array  The Elasticsearch response
     */
    private function request(HttpRequest $httpRequest, $params = [])
    {

        return response()->json( $params );

    }


    /**
     * Parse the response from the search against ES enpoint
     *
     * @param array  The response as it came back from Elasitcsearch
     * @return array  An API-friendly response array
     */
    private function response(array $response, $is_empty = false)
    {

        $resp = new SearchResponse($response);

        return $resp->response();

    }


    /**
     * Decide if the incoming request is an empty search
     *
     * @param HttpRequest  The incoming request to this controller
     * @return boolean
     */
    private function isEmptySearch($httpRequest)
    {

        $input = SearchRequest::getValidInput( $httpRequest );

        if( !is_null( $input['q'] ) )
        {
            return false;
        }

        return true;
    }


    /**
     * The actual query sent by the official ES PHP client
     *
     * @return string  Json string
     */
    private function jsonQuery()
    {

        return response( Elasticsearch::connection('default')->transport->lastConnection->getLastRequestInfo()['request']['body'] )->header('Content-Type', 'application/json');

    }

}
