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
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */


    /**
     * General entry point for search. There are three modes:
     *
     * 1. Don't pass any params to view all works, magically sorted.
     * 2. Pass `q` param w/ string for a simple, optimized search.
     * 3. Pass `q` param *and* subset of ES Request Body params.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-body.html
     *
     * @return void
     */
    public function search(HttpRequest $httpRequest)
    {

        $response = [];
        try {
            $response = $this->request($httpRequest);
        } catch (\Exception $e) {
            return response( $e->getMessage(), $e->getCode() )->header('Content-Type', 'application/json');
        }

        // return $this->jsonQuery();

        return $this->response($response, $this->simple($httpRequest));

    }


    /**
     * Autocomplete entry point for search.
     *
     * @return void
     */
    public function autocomplete(HttpRequest $httpRequest)
    {

        $response = [];
        try {
            $response = $this->request($httpRequest); //, $searchRequest->autocompleteParams());
        } catch (\Exception $e) {
            return response( $e->getMessage(), $e->getCode() )->header('Content-Type', 'application/json');
        }

        //return $this->jsonQuery();

        return $this->response($response, $this->simple($httpRequest));

    }


    /**
     * Perform the search against ES enpoint
     *
     * @param HttpRequest  The incoming request to this controller
     * @return array  The Elasticsearch response
     */
    private function request(HttpRequest $httpRequest, $params = [])
    {

        $searchRequest = new SearchRequest($httpRequest);
        $type = $searchRequest->type();
        
        if (empty($params))
        {

            $params = $searchRequest->params();

        }

        // Keeping this here for debug purposes:
        // return response()->json( $params );

        return Elasticsearch::search( $params );
    }


    /**
     * Parse the response from the search against ES enpoint
     *
     * @param array  The response as it came back from Elasitcsearch
     * @return array  An API-friendly response array
     */
    private function response(array $response, $simple = false)
    {

        $resp = new SearchResponse($response);

        $resp->simple = $simple;

        return $resp->response();

    }


    /**
     * Decide if the incoming request is a simple query
     *
     * @param HttpRequest  The incoming request to this controller
     * @return boolean
     */
    private function simple($httpRequest)
    {

        $searchRequest = new SearchRequest($httpRequest);
        $input = $searchRequest->validInput();
        if( !is_null( $input['q'] ) ) {
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

        return response()->json( json_decode( Elasticsearch::connection('default')->transport->lastConnection->getLastRequestInfo()['request']['body'] ) );

    }

}
