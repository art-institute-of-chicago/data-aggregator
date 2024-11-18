<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\Exceptions\DetailedException;
use App\Http\Search\Request as SearchRequest;
use App\Http\Search\CsvResponse as SearchResponse;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Http\Request;
use Elasticsearch;

class CsvSearchController extends SearchController
{
    public function search(Request $request, $resource = null)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'inline',
        ];
        $data = $this->query('getSearchParams', 'getSearchResponse', 'search', $resource);
        $titles = array_keys($data[0]);

        $callback = function () use ($data, $titles) {
            $output = fopen('php://output', 'w');
            fputcsv($output, $titles);
            foreach ($data as $row) {
                fputcsv($output, $row);
            }
            fclose($output);
        };
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Helper method to perform a query against Elasticsearch endpoint.
     *
     * @param string $requestMethod  Name of transformation method on SearchRequest class
     * @param string $responseMethod  Name of transformation method on SearchResponse class
     * @param array $resource Resource to search (translates to index and type)
     * @param string $id Identifier of a resource (meant for explain)
     *
     * @return \Illuminate\Http\Response
     */
    protected function query($requestMethod, $responseMethod, $elasticsearchMethod, $resource, $id = null, $requestArgs = null)
    {
        // Combine any configuration params
        $input = RequestFacade::all();
        $input = $requestArgs ? array_merge($input, $requestArgs) : $input;

        // Transform our API's syntax into an Elasticsearch params array
        $params = (new SearchRequest($resource, $id))->{$requestMethod}($input);
        $results = null;

        try {
            $results = Elasticsearch::$elasticsearchMethod($params);
        } catch (\Exception $e) {
            // Elasticsearch occasionally returns a status code of zero
            $code = $e->getCode() > 0 ? $e->getCode() : 500;

            return response($e->getMessage(), $code)->header('Content-Type', 'text/csv');
        }

        // Transform Elasticsearch results into our API standard
        $response = (new SearchResponse($results, $params, $resource))->{$responseMethod}();

        return $response;
    }
}
