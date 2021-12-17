<?php

namespace App\Http\Search;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request as RequestFacade;

class Response
{

    /**
     * Response as it came back from Elasticsearch
     *
     * @var array
     */
    public $searchResponse;

    /**
     * Params passed to Elasticsearch
     *
     * @var array
     */
    public $searchParams;

    /**
     * Resource targeted by this search request. Derived from API endpoint, or from `resources` param.
     * Accepted as comma-separated string, or as array. Converted to array shortly after `__construct()`.
     *
     * @var array
     */
    public $resources;

    /**
     * Create a new request instance.
     *
     * @param array $searchResponse Response as it came back from Elasticsearch
     * @param array $searchParams Params passed to Elasticsearch
     *
     * @return void
     */
    public function __construct(array $searchResponse, array $searchParams, $resources = null)
    {
        $this->searchResponse = $searchResponse;
        $this->searchParams = $searchParams;
        $this->resources = $this->getResources($resources);
    }

    private function getResources($resources = null)
    {
        if (!isset($resources) && isset($this->resources)) {
            return $this->resources;
        }

        $resources = $resources ?? RequestFacade::input('resources') ?? 'articles';
        $resources = is_array($resources) ? $resources : explode(',', $resources);

        return $this->resources = $resources;
    }

    /**
     * Transform response for search queries.
     *
     * @return array
     */
    public function getSearchResponse()
    {
        $response = array_merge(
            $this->paginate(),
            $this->data(),
            $this->info()
        );

        $response = array_merge(
            $response,
            $this->aggregate()
        );

        $response = array_merge(
            [
                'preference' => $this->searchParams['preference'] ?? null,
            ],
            $response
        );

        return $response;
    }

    /**
     * Transform response for explain queries.
     *
     * @return array
     */
    public function getRawResponse()
    {
        return $this->searchResponse;
    }

    /**
     * Transform response for autocomplete queries.
     *
     * @return array
     */
    public function getAutocompleteWithTitleResponse()
    {
        // Defaulting to [] is safe, but ineffecient: catch empty `q` earlier!
        return $this->getAutocompleteWithTitle()['suggest']['autocomplete'] ?? [];
    }

    /**
     * Transform response for autocomplete queries. Pass-through the source.
     *
     * @return array
     */
    public function getAutocompleteWithSourceResponse()
    {
        $options = Arr::get($this->searchResponse, 'suggest.autocomplete.0.options');

        if ($options) {
            return Arr::pluck($options, '_source');
        }

        return [];
    }

    /**
     * Add pagination to response.
     *
     * @return array
     */
    private function paginate()
    {
        // We assume that `size` and `from` have been set via getPaginationParams()
        // This method should not be used for endpoints that return no results

        // LengthAwarePaginator has trouble here
        $total = $this->searchResponse['hits']['total'];
        $limit = $this->searchParams['size'] ?? 10;
        $offset = $this->searchParams['from'] ?? 0;

        // Avoid division by zero
        if ($limit > 0) {
            $total_pages = ceil($total / $limit);
            $current_page = floor($offset / $limit) + 1;
        } else {
            $total_pages = null;
            $current_page = null;
        }

        $pagination = [
            'total' => $total,
            'limit' => $limit,
            'offset' => $offset,
            'total_pages' => $total_pages,
            'current_page' => $current_page,
        ];

        return [
            'pagination' => $pagination,
        ];
    }

    /**
     * Add data (i.e. hits, results) to response.
     *
     * @return array
     */
    private function data()
    {
        $hits = $this->searchResponse['hits']['hits'];
        $results = [];

        $input = RequestFacade::all();
        $fields = $input['fields'] ?? [];
        $fields = is_string($fields) ? array_map('trim', explode(',', $fields)) : $fields;

        // Reduce to just the _source objects
        foreach ($hits as $hit) {
            $result = [
                '_score' => $hit['_score'],
            ];

            // Avoid filtering fields here: filter fields via `_source` in Request instead
            // This will reduce AWS ES load - it won't need to return as much data
            // Note that `_source` might be undefined if `_source` was set to false in Request
            if (isset($hit['_source'])) {
                $result = array_merge($result, $hit['_source']);
            }

            // WEB-1273: Remove any restricted fields for anonymous users. We already do this
            // in Search\Request::getFieldParams(), but only for single-resource requests.
            // We need to do this here b/c there's no way to target `fields` at specific indexes.
            if (Gate::denies('restricted-access') && isset($result['api_model'])) {
                $restrictedFields = app('Resources')->getRetrictedFieldNamesForEndpoint($result['api_model']);
                $result = array_diff_key($result, array_flip($restrictedFields));

                // We needed it for typechecking, but not anymore
                if (!empty($fields) && !in_array('api_model', $fields)) {
                    unset($result['api_model']);
                }
            }

            $results[] = $result;
        }

        return [
            'data' => $results,
        ];
    }

    private function info()
    {
        $resources = $this->getResources();

        $transformers = array_map(function ($resource) {
            $transformer = app('Resources')->getTransformerForEndpoint($resource);
            return new $transformer;
        }, $resources);

        // Sort transformers by license priority, ascending:
        usort($transformers, function ($a, $b) {
            $pa = $a->getLicensePriority();
            $pb = $b->getLicensePriority();

            if ($pa === $pb) {
                return 0;
            }

            return ($pa < $pb) ? -1 : 1;
        });

        $maxTransformer = end($transformers);

        $info['license_text'] = $maxTransformer ? $maxTransformer->getLicenseText() : null;
        $info['license_links'] = $maxTransformer ? $maxTransformer->getLicenseLinks() : null;
        $info['version'] = config('aic.version');

        return [
            'info' => $info,
        ];
    }

    /**
     * Add suggestions (i.e. completion, phrases) to response.
     *
     * @return array
     */
    private function getAutocompleteWithTitle()
    {
        $suggest = [];

        $options = Arr::get($this->searchResponse, 'suggest.autocomplete.0.options');

        if ($options) {
            $suggest['autocomplete'] = Arr::pluck($options, '_source.title');
        }

        if ($suggest) {
            return ['suggest' => $suggest];
        }

        return [];
    }

    /**
     * Add aggregations (i.e. facets) to response. Again, straight pass-through.
     *
     * @return array
     */
    private function aggregate()
    {
        $aggregations = $this->searchResponse['aggregations'] ?? null;

        return $aggregations ? ['aggregations' => $aggregations] : [];
    }
}
