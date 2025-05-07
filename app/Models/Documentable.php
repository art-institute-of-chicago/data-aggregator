<?php

namespace App\Models;

use Laminas\Code\Reflection\ClassReflection;
use Illuminate\Support\Str;
use App\Scopes\PublishedScope;

trait Documentable
{
    public static $NL = "\n";
    public static $NLNL = "\n\n";
    public static $GET_H5 = '##### `GET ';


    private $docAppUrl;
    private $docRequestUrl;

    /**
     * Generate endpoint documentation for this model
     *
     * @return string
     */
    public function docEndpoints()
    {
        $this->docAppUrl = config('aic.production_url') . '/api/v1';
        $this->docRequestUrl = config('app.url') . '/api/v1';

        $doc = '';
        $doc .= $this->docTitle() . self::$NLNL;
        $doc .= $this->docLicense() . self::$NLNL;
        $doc .= $this->docList() . self::$NL;

        if ($this->hasSearchEndpoint()) {
            $doc .= $this->docSearch() . self::$NL;
        }

        $doc .= $this->docSingle() . self::$NL;

        if ($this->docExtra()) {
            $doc .= $this->docExtra() . self::$NL;
        }

        return $doc;
    }

    /**
     * Generate field documentation for this model
     *
     * @return string
     */
    public function docFields()
    {
        $endpoint = app('Resources')->getEndpointForModel(get_called_class());

        $doc = '';
        $doc .= $this->docTitle() . self::$NLNL;
        $doc .= $this->docDescription() . ' For a description of all the endpoints available for this resource, see [here](#' . $endpoint . ")." . self::$NLNL;
        $doc .= $this->docListFields() . self::$NLNL;

        return $doc;
    }

    /**
     * Generate a title for this resource
     *
     * @return string
     */
    public function docTitle()
    {
        $endpoint = app('Resources')->getEndpointForModel(get_called_class());

        return '#### ' . str_replace('-', ' ', Str::title($endpoint));
    }

    /**
     * Generate the license of this resource
     *
     * @return string
     */
    public function docLicense()
    {
        $transformer = app('Resources')->getTransformerForModel(get_called_class());
        $transformer = new $transformer();
        return '_' . $transformer->getLicenseText() . '_';
    }

    /**
     * Generate a description of this resource
     *
     * @return string
     */
    public function docDescription()
    {
        $rc = new ClassReflection(get_called_class());

        try {
            return $rc->getDocBlock()->getShortDescription();
        } catch (\Throwable $e) {
            throw new \Exception('DocBlock is missing for model ' . get_called_class());
        }
    }

    /**
     * Generate documentation for list endpoint
     *
     * @return string
     */
    public function docList()
    {
        $endpoint = app('Resources')->getEndpointForModel(get_called_class());

        // Title
        $doc = self::$GET_H5 . $this->endpointPath() . "`" . self::$NLNL;

        $doc .= $this->docListDescription() . ' For a description of all the fields included with this response, see [here](#' . $endpoint . "-2)." . self::$NLNL;

        $doc .= $this->docListParameters();

        $doc .= $this->docExampleOutput([], true);

        return $doc;
    }

    /**
     * Generate description for list endpoint
     *
     * @return string
     */
    public function docListDescription($endpoint = '')
    {
        $endpointAsCopyText = $this->endpointAsCopyText($endpoint);

        return 'A list of all ' . $endpointAsCopyText . ' sorted by last updated date in descending order.';
    }

    /**
     * Generate documentation for listing fields
     *
     * @return string
     */
    public function docListFields()
    {
        $doc = '';

        foreach ($this->transformMapping() as $array) {
            if ($array['is_restricted'] ?? false) {
                continue;
            }
            $doc .= '* `' . $array['name'] . '` ' . (array_key_exists('type', $array) ? '*' . $array['type'] . '* ' : '') . '- ' . $array['doc'] . self::$NL;
        }

        $doc .= self::$NL;

        return $doc;
    }

    /**
     * Generate documentation for search endpoint
     *
     * @return string
     */
    public function docSearch()
    {
        // Title
        $doc = self::$GET_H5 . $this->endpointPath(['extraPath' => 'search']) . "`" . self::$NLNL;

        $doc .= $this->docSearchDescription() . self::$NLNL;

        $doc .= $this->docSearchParameters();

        $doc .= $this->docExampleSearchOutput($this->exampleSearchQuery());

        return $doc;
    }

    /**
     * Generate description for search endpoint
     *
     * @return string
     */
    public function docSearchDescription()
    {
        $endpointAsCopyText = $this->endpointAsCopyText();

        return 'Search ' . $endpointAsCopyText . ' data in the aggregator. ' . $this->extraSearchDescription();
    }

    /**
     * Generate documentation for single resource endpoint
     *
     * @return string
     */
    public function docSingle()
    {
        // Title
        $doc = self::$GET_H5 . $this->endpointPath(['extraPath' => '{id}']) . "`" . self::$NLNL;

        $doc .= $this->docSingleDescription() . self::$NLNL;

        if ($id = $this->exampleId()) {
            $doc .= $this->docExampleOutput(['id' => $id]);
        }

        return $doc;
    }

    /**
     * For this resource, add this to the full documentation.
     *
     * @return string
     */
    public function docExtra()
    {
        return '';
    }

    /**
     * Generate description for single resource endpoint
     *
     * @return string
     */
    public function docSingleDescription($endpoint = '')
    {
        $endpointAsCopyText = $this->endpointAsCopyText($endpoint);

        $doc = 'A single ' . Str::singular($endpointAsCopyText) . ' by the given identifier.';

        if (static::$source === 'Collections') {
            $doc .= ' {id} is the identifier from our collections management system.';
        }

        return $doc;
    }

    /**
     * Generate documentation for parameters for list endpoints
     *
     * @return string
     */
    public function docListParameters()
    {
        $doc = '';
        $doc .= "###### Available parameters:" . self::$NLNL;

        foreach ($this->docListParametersRaw() as $param => $description) {
            $doc .= '* `' . $param . '` - ' . $description . self::$NL;
        }

        $doc .= $this->docIncludeParameters();

        return $doc;
    }

    /**
     * Raw list of parameters used with list endpoints
     *
     * @return array
     */
    public function docListParametersRaw()
    {
        return [
            'ids' => 'A comma-separated list of resource ids to retrieve',
            'limit' => 'The number of resources to return per page',
            'page' => 'The page of resources to retrieve',
            'fields' => 'A comma-separated list of fields to return per resource',
        ];
    }

    /**
     * Generate documentation for parameters for search endpoints
     *
     * @return string
     */
    public function docSearchParameters()
    {
        $doc = '';

        $doc .= "###### Available parameters:" . self::$NLNL;

        foreach ($this->docSearchParametersRaw() as $param => $description) {
            $doc .= '* `' . $param . '` - ' . $description . self::$NL;
        }

        $doc .= self::$NL;

        return $doc;
    }

    /**
     * Raw list of parameters used with search endpoints
     *
     * @return string
     */
    public function docSearchParametersRaw()
    {
        return [
            'q' => 'Your search query',
            'query' => 'For complex queries, you can pass Elasticsearch domain syntax queries here',
            'sort' => 'Used in conjunction with `query`',
            'from' => 'Starting point of results. Pagination via Elasticsearch conventions',
            'size' => 'Number of results to return. Pagination via Elasticsearch conventions',
            'facets' => 'A comma-separated list of \'count\' aggregation facets to include in the results.',
        ];
    }

    /**
     * Generate documentation for the `include` parameters for list endpoints
     *
     * @return string
     */
    public function docIncludeParameters()
    {
        $transformerClass = app('Resources')->getTransformerForModel(get_called_class());
        $transformer = new $transformerClass();

        $doc = '';

        if ($transformer->getAvailableIncludes()) {
            $doc .= "* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:" . self::$NL;

            foreach ($transformer->getAvailableIncludes() as $include) {
                $doc .= '  * `' . $include . "`" . self::$NL;
            }
        }

        $doc .= self::$NL;

        return $doc;
    }

    /**
     * Generate documentation for example query and response
     *
     * @return string
     */
    public function docExampleOutput($options = [], $captureSampleId = false)
    {
        $defaults = [
            'extraPath' => '',
            'extraAtEnd' => false,
            'getParams' => 'limit=2',
            'id' => '',
        ];

        $options = array_merge($defaults, $options);

        $requestUrl = $this->docRequestUrl . $this->endpointPath($options) . (!$options['id'] ? '?' . $options['getParams'] : '');
        $appUrl = $this->docAppUrl . $this->endpointPath($options) . (!$options['id'] ? '?' . $options['getParams'] : '');

        $doc = '::: details Example request: ' . $appUrl . "  " . self::$NL;

        $textResponse = file_get_contents($requestUrl);
        sleep(1); // Throttle requests to the API

        // Swap out the local URL with the production URL to display a relevant response in the doco
        $textResponse = str_replace(
            str_replace('/', '\/', $this->docRequestUrl),
            str_replace('/', '\/', $this->docAppUrl),
            $textResponse
        );
        $response = json_decode($textResponse);

        // For brevity, only show the first few fields in the results
        if (property_exists($response, 'data')) {
            if (is_array($response->data)) {
                foreach ($response->data as $index => $datum) {
                    $response->data[$index] = $this->addEllipsis($response->data[$index]);
                }
            } else {
                $response->data = $this->addEllipsis($response->data);
            }
        }

        if (property_exists($response, 'metadata')) {
            $response->metadata = $this->addEllipsis($response->metadata);
        }

        if (property_exists($response, 'sequences')) {
            $response->sequences = $this->addEllipsis($response->sequences);
        }

        $json = json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $json = str_replace('"...": null', '...', $json);

        // Output
        $doc .= "```js" . self::$NL;
        $doc .= $json . self::$NL;
        $doc .= "```" . self::$NL;
        $doc .= ":::" . self::$NL;

        return $doc;
    }

    /**
     * Generate documentation for example search query and response
     *
     * @return string
     */
    public function docExampleSearchOutput($getParams = '')
    {
        $appUrl = $this->docAppUrl . $this->endpointPath() . '/search' . ($getParams ? '?' . $getParams : '');

        $doc = '::: details Example request: ' . $appUrl . self::$NL;

        $response = json_decode(file_get_contents($appUrl));
        sleep(1); // Throttle requests to the API

        // For brevity, only show the first few results
        foreach ($response->data as $index => $datum) {
            if ($index > 2) {
                unset($response->data[$index]);
            }
        }

        $json = json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        // Output
        $doc .= "```js" . self::$NL;
        $doc .= $json . self::$NL;
        $doc .= "```" . self::$NL;
        $doc .= ":::" . self::$NL;

        return $doc;
    }

    /**
     * Helper to retrieve the source attribute, i.e. where the model comes from.
     *
     * @return string
     */
    public static function source()
    {
        return static::$source;
    }

    /**
     * Get any extra descriptions of the search endpoint for this resource
     *
     * @return string
     */
    public function extraSearchDescription()
    {
        return '';
    }

    /**
     * Get an example search query for documentation generation
     *
     * @return string
     */
    public function exampleSearchQuery()
    {
        return '';
    }

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {
        self::addGlobalScope(new PublishedScope());
        $exampleRecord = self::first();

        return $exampleRecord
            ? $exampleRecord->getKeyForDoc()
            : null;
    }

    protected function getKeyForDoc()
    {
        return $this->getKey();
    }

    /**
     * Whether this resource has a `/search` endpoint
     *
     * @return boolean
     */
    public function hasSearchEndpoint()
    {
        return app('Resources')->isModelSearchable(get_called_class());
    }

    /**
     * Generate openapi endpoint documentation for this model
     *
     * @return string
     */
    public function openapiEndpoints()
    {
        $doc = $this->openapiList() . self::$NL;

        if ($this->hasSearchEndpoint()) {
            $doc .= $this->openapiSearch() . self::$NL;
        }

        $doc .= $this->openapiSingle() . self::$NL;

        if (get_called_class() === Collections\Agent::class) {
            // Artists
            $doc .= $this->openapiList('artists') . self::$NL;
            $doc .= $this->openapiSingle('artists') . self::$NL;
        } elseif (get_called_class() === Collections\Category::class) {
            // Department
            $doc .= $this->openapiList('departments') . self::$NL;
            $doc .= $this->openapiSingle('departments') . self::$NL;
        }

        return $doc;
    }

    /**
     * Generate openapi field documentation for this model
     *
     * @return string
     */
    public function openapiFields()
    {
        $model = get_called_class();
        $modelBasename = class_basename($model);

        $doc = '    "' . $modelBasename . "\": {" . self::$NL;
        $doc .= "      \"properties\": {" . self::$NL;
        $doc .= $this->openapiListFields();
        $doc .= "      }," . self::$NL;
        $doc .= "      \"type\": \"object\"" . self::$NL;
        $doc .= "    }," . self::$NL;

        $doc .= self::$NL;

        return $doc;
    }

    /**
     * Generate openapi documentation for listing fields
     *
     * @return string
     */
    public function openapiListFields()
    {
        $doc = '';
        $mapping = $this->transformMapping();

        foreach ($mapping as $array) {
            $doc .= '        "' . $array['name'] . "\": {" . self::$NL;
            $doc .= '          "description": "' . str_replace('"', '\"', $array['doc']) . "\"" . self::$NL;
            $doc .= '        }' . ($array !== end($mapping) ? ',' : '') . self::$NL;
        }

        return $doc;
    }

    /**
     * Generate openapi list endpoint documentation for this model
     *
     * @return string
     */
    public function openapiList($endpoint = null)
    {
        $doc = '    "/' . ($endpoint ?? app('Resources')->getEndpointForModel(get_called_class())) . "\": {" . self::$NL;
        $doc .= "      \"get\": {" . self::$NL;
        $doc .= $this->openapiTags();
        $doc .= '        "description": "' . $this->docListDescription($endpoint) . "\"," . self::$NL;
        $doc .= $this->openapiProduces();
        $doc .= $this->openapiParameters();
        $doc .= $this->openapiResponses();
        $doc .= "      }" . self::$NL;
        $doc .= "    }," . self::$NL;

        return $doc;
    }

    /**
     * Generate openapi search endpoint documentation for this model
     *
     * @return string
     */
    public function openapiSearch()
    {
        $doc = '    "/' . app('Resources')->getEndpointForModel(get_called_class()) . "/search\": {" . self::$NL;
        $doc .= "      \"get\": {" . self::$NL;
        $doc .= $this->openapiTags(['search']);
        $doc .= '        "summary": "' . $this->docSearchDescription() . "\"," . self::$NL;
        $doc .= $this->openapiParameters($this->docSearchParametersRaw());
        $doc .= $this->openapiResponses('SearchResult');
        $doc .= "      }" . self::$NL;
        $doc .= "    }," . self::$NL;

        return $doc;
    }

    /**
     * Generate openapi single endpoint documentation for this model
     *
     * @return string
     */
    public function openapiSingle($endpoint = null)
    {
        $doc = '    "/' . ($endpoint ?? app('Resources')->getEndpointForModel(get_called_class())) . "/{id}\": {" . self::$NL;
        $doc .= "      \"get\": {" . self::$NL;
        $doc .= $this->openapiTags();
        $doc .= '        "summary": "' . $this->docSingleDescription($endpoint) . "\"," . self::$NL;
        $doc .= $this->openapiProduces();
        $doc .= $this->openapiParameters(['id' => 'Resource id to retrieve']);
        $doc .= $this->openapiResponses();
        $doc .= "      }" . self::$NL;
        $doc .= "    }," . self::$NL;

        return $doc;
    }

    public function openapiTags($extras = [])
    {
        $model = get_called_class();
        $endpoint = app('Resources')->getEndpointForModel($model);
        $source = $model::source();

        $doc = "        \"tags\": [" . self::$NL;
        $doc .= '            "' . $endpoint . "\"," . self::$NL;
        $doc .= '            "' . strtolower($source) . '"';

        foreach ($extras as $tag) {
            $doc .= "," . self::$NL;
            $doc .= '            "' . $tag . '"';
        }

        $doc .= self::$NL;
        $doc .= "        ]," . self::$NL;

        return $doc;
    }

    public function openapiProduces()
    {
        $doc = "        \"produces\": [" . self::$NL;
        $doc .= "          \"application/json\"" . self::$NL;
        $doc .= "        ]," . self::$NL;

        return $doc;
    }

    /**
     * Generate openapi parameters for this model
     *
     * @return string
     */
    public function openapiParameters($params = [])
    {
        $doc = "        \"parameters\": [" . self::$NL;
        $array = $params ?? $this->docListParametersRaw();

        foreach ($array as $param => $description) {
            $doc .= "          {" . self::$NL;
            $doc .= '            "$ref": "#/parameters/' . $param . "\"" . self::$NL;
            $doc .= '          }' . ($description !== end($array) ? ',' : '') . self::$NL;
        }

        $doc .= "        ]," . self::$NL;

        return $doc;
    }

    public function openapiResponses($modelBasename = null)
    {
        if (!$modelBasename) {
            $model = get_called_class();
            $modelBasename = class_basename($model);
        }

        $doc = "        \"responses\": {" . self::$NL;
        $doc .= "          \"200\": {" . self::$NL;
        $doc .= "            \"description\": \"Successful operation\"," . self::$NL;
        $doc .= "            \"schema\": {" . self::$NL;
        $doc .= "              \"type\": \"array\"," . self::$NL;
        $doc .= "              \"items\": {" . self::$NL;
        $doc .= '                "$ref": "#/definitions/' . $modelBasename . "\"" . self::$NL;
        $doc .= "              }" . self::$NL;
        $doc .= "            }" . self::$NL;
        $doc .= "          }," . self::$NL;
        $doc .= "          \"default\": {" . self::$NL;
        $doc .= "            \"description\": \"error\"," . self::$NL;
        $doc .= "            \"schema\": {" . self::$NL;
        $doc .= "              \"\$ref\": \"#/definitions/Error\"" . self::$NL;
        $doc .= "            }" . self::$NL;
        $doc .= "          }" . self::$NL;
        $doc .= "        }" . self::$NL;

        return $doc;
    }

    /**
     * Generate an endpoint name as copy text
     *
     * @return string
     */
    protected function endpointAsCopyText($endpoint = '')
    {
        if (!$endpoint) {
            $endpoint = app('Resources')->getEndpointForModel(get_called_class());
        }

        return strtolower(Str::title($endpoint));
    }

    /**
     * Generate an endpoint path
     *
     * @return string
     */
    protected function endpointPath($options = [])
    {
        $defaults = [
            'extraPath' => '',
            'extraAtEnd' => false,
            'id' => '',
        ];

        $options = array_merge($defaults, $options);

        $endpoint = app('Resources')->getEndpointForModel(get_called_class());

        $path = '/' . $endpoint;

        if ($options['extraPath']) {
            if (!$options['extraAtEnd'] || $options['extraAtEnd'] === false) {
                $path .= '/' . $options['extraPath'];
            }
        }

        if ($options['id']) {
            $path .= '/' . $options['id'];
        }

        if ($options['extraPath']) {
            if ($options['extraAtEnd'] && $options['extraAtEnd'] === true) {
                $path .= '/' . $options['extraPath'];
            }
        }

        return rtrim($path, '/');
    }

    private function addEllipsis($obj)
    {
        if (is_object($obj)) {
            $keys = get_object_vars($obj);
            $addEllipsis = false;
            $i = 0;

            foreach ($keys as $keyIndex => $key) {
                if ($i > 5) {
                    unset($obj->{$keyIndex});
                    $addEllipsis = true;
                }
                $i++;
            }

            $obj->{'...'} = null;
        }

        if (is_array($obj)) {
            $keys = array_keys($obj);
            $addEllipsis = false;
            $i = 0;

            foreach ($keys as $key) {
                if ($i > 5) {
                    unset($obj[$key]);
                    $addEllipsis = true;
                }
                $i++;
            }

            $obj[] = '...';
        }

        return $obj;
    }
}
