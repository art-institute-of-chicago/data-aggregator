<?php

namespace App\Models;

use Zend\Code\Reflection\ClassReflection;

use Illuminate\Support\Str;

use App\Scopes\PublishedScope;

trait Documentable
{

    private $docAppUrl;
    private $docRequestUrl;

    /**
     * Generate endpoint documentation for this model
     *
     * @return string
     */
    public function docEndpoints()
    {
        if ($this->docOnly()) {
            return $this->docOnly();
        }

        $this->docAppUrl = config('aic.production_url') . '/api/v1';
        $this->docRequestUrl = config('app.url') . '/api/v1';

        $doc = '';
        $doc .= $this->docTitle() . "\n\n";
        $doc .= $this->docLicense() . "\n\n";
        $doc .= $this->docList() . "\n";

        if ($this->hasSearchEndpoint()) {
            $doc .= $this->docSearch() . "\n";
        }

        $doc .= $this->docSingle() . "\n";

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
        $doc .= $this->docTitle() . "\n\n";
        $doc .= $this->docDescription() . ' For a description of all the endpoints available for this resource, see [here](endpoints#' . $endpoint . ").\n\n";

        if (!$this->docOnly()) {
            $doc .= $this->docListFields() . "\n\n";
        }

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

        return '### ' . str_replace('-', ' ', Str::title($endpoint));
    }

    /**
     * Generate the license of this resource
     *
     * @return string
     */
    public function docLicense()
    {
        $transformer = app('Resources')->getTransformerForModel(get_called_class());
        $transformer = new $transformer;
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
        $doc = '#### `GET ' . $this->_endpointPath() . "`\n\n";

        $doc .= $this->docListDescription() . ' For a description of all the fields included with this response, see [here](fields#' . $endpoint . ").\n\n";

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
        $endpointAsCopyText = $this->_endpointAsCopyText($endpoint);

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

        foreach ($this->transformMapping() as $array)
        {
            if ($array['is_restricted'] ?? false) {
                continue;
            }
            $doc .= '* `' . $array['name'] . '` ' . (array_key_exists('type', $array) ? '*' . $array['type'] . '* ' : '') . '- ' . $array['doc'] . "\n";
        }

        $doc .= "\n";

        return $doc;
    }

    /**
     * Generate documentation for search endpoint
     *
     * @return string
     */
    public function docSearch()
    {
        $endpointAsCopyText = $this->_endpointAsCopyText();

        // Title
        $doc = '#### `GET ' . $this->_endpointPath(['extraPath' => 'search']) . "`\n\n";

        $doc .= $this->docSearchDescription() . "\n\n";

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
        $endpointAsCopyText = $this->_endpointAsCopyText();

        return 'Search ' . $endpointAsCopyText . ' data in the aggregator. ' . $this->extraSearchDescription();
    }

    /**
     * Generate documentation for single resource endpoint
     *
     * @return string
     */
    public function docSingle()
    {
        $endpointAsCopyText = $this->_endpointAsCopyText();

        // Title
        $doc = '#### `GET ' . $this->_endpointPath(['extraPath' => '{id}']) . "`\n\n";

        $doc .= $this->docSingleDescription() . "\n\n";

        if ($id = $this->exampleId())
        {
            $doc .= $this->docExampleOutput(['id' => $id]);
        }

        return $doc;
    }

    /**
     * Generate description for single resource endpoint
     *
     * @return string
     */
    public function docSingleDescription($endpoint = '')
    {
        $endpointAsCopyText = $this->_endpointAsCopyText($endpoint);

        $doc = 'A single ' . Str::singular($endpointAsCopyText) . ' by the given identifier.';

        if (static::$source === 'Collections')
        {
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
        $doc .= "##### Available parameters:\n\n";

        foreach ($this->docListParametersRaw() as $param => $description)
        {
            $doc .= '* `' . $param . '` - ' . $description . "\n";
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

        $doc .= "##### Available parameters:\n\n";

        foreach ($this->docSearchParametersRaw() as $param => $description)
        {
            $doc .= '* `' . $param . '` - ' . $description . "\n";
        }

        $doc .= "\n";

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

        if ($transformer->getAvailableIncludes())
        {
            $doc .= "* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:\n";

            foreach ($transformer->getAvailableIncludes() as $include)
            {
                $doc .= '  * `' . $include . "`\n";
            }
        }

        $doc .= "\n";

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
            'getParams' => 'limit=2',
            'id' => '',
        ];

        $options = array_merge($defaults, $options);

        $requestUrl = $this->docRequestUrl . $this->_endpointPath($options) . ($options['getParams'] ? '?' . $options['getParams'] : '');
        $appUrl = $this->docAppUrl . $this->_endpointPath($options) . ($options['getParams'] ? '?' . $options['getParams'] : '');

        $doc = '::: details Example request: ' . $appUrl . "  \n";

        $textResponse = file_get_contents($requestUrl);
        sleep(1); // Throttle requests to the API

        // Swap out the local URL with the production URL to display a relevant response in the doco
        $textResponse = str_replace(str_replace('/', '\/', $this->docRequestUrl),
                                    str_replace('/', '\/', $this->docAppUrl),
                                    $textResponse);
        $response = json_decode($textResponse);

        // For brevity, only show the first fiew fields in the results
        if (is_array($response->data))
        {
            foreach ($response->data as $index => $datum)
            {

                $response->data[$index] = $this->_addEllipsis($response->data[$index]);

            }

        }
        else {

            $response->data = $this->_addEllipsis($response->data);

        }

        $json = json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $json = str_replace('"...": null', '...', $json);

        // Output
        $doc .= "```js\n";
        $doc .= $json . "\n";
        $doc .= "```\n";
        $doc .= ":::\n";

        return $doc;
    }

    /**
     * Generate documentation for example search query and response
     *
     * @return string
     */
    public function docExampleSearchOutput($getParams = '')
    {
        $appUrl = $this->docAppUrl . $this->_endpointPath() . '/search' . ($getParams ? '?' . $getParams : '');

        $doc = "::: details Example request: " . $appUrl . "\n";

        $response = json_decode(file_get_contents($appUrl));
        sleep(1); // Throttle requests to the API

        // For brevity, only show the first few results
        foreach ($response->data as $index => $datum)
        {
            if ($index > 2)
            {
                unset($response->data[$index]);
            }
        }

        $json = json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        // Output
        $doc .= "```js\n";
        $doc .= $json . "\n";
        $doc .= "```\n";
        $doc .= ":::\n";

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
        self::addGlobalScope(new PublishedScope);
        $exampleRecord = self::first();

        return $exampleRecord ? $exampleRecord->getKey() : null;
    }

    /**
     * For this resource, use this as the full documentation.
     *
     * @return string
     */
    public function docOnly()
    {
        return '';
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
     * Generate swagger endpoint documentation for this model
     *
     * @return string
     */
    public function swaggerEndpoints()
    {
        if ($this->docOnly())
        {
            return '';
        }

        $doc = $this->swaggerList() . "\n";

        if ($this->hasSearchEndpoint())
        {
            $doc .= $this->swaggerSearch() . "\n";
        }

        $doc .= $this->swaggerSingle() . "\n";

        if (get_called_class() === Collections\Agent::class)
        {
            // Artists
            $doc .= $this->swaggerList('artists') . "\n";
            $doc .= $this->swaggerSingle('artists') . "\n";
        }
        elseif (get_called_class() === Collections\Category::class)
        {
            // Department
            $doc .= $this->swaggerList('departments') . "\n";
            $doc .= $this->swaggerSingle('departments') . "\n";
        }

        return $doc;
    }

    /**
     * Generate swagger field documentation for this model
     *
     * @return string
     */
    public function swaggerFields()
    {
        $model = get_called_class();
        $modelBasename = class_basename($model);

        $doc = '    "' . $modelBasename . "\": {\n";
        $doc .= "      \"properties\": {\n";
        $doc .= $this->swaggerListFields();
        $doc .= "      },\n";
        $doc .= "      \"type\": \"object\"\n";
        $doc .= "    },\n";

        $doc .= "\n";

        return $doc;
    }

    /**
     * Generate swagger documentation for listing fields
     *
     * @return string
     */
    public function swaggerListFields()
    {
        $doc = '';
        $mapping = $this->transformMapping();

        foreach ($mapping as $array)
        {
            $doc .= '        "' . $array['name'] . "\": {\n";
            $doc .= '          "description": "' . str_replace('"', '\"', $array['doc']) . "\"\n";
            $doc .= '        }' . ($array !== end($mapping) ? ',' : '') . "\n";
        }

        return $doc;
    }

    /**
     * Generate swagger list endpoint documentation for this model
     *
     * @return string
     */
    public function swaggerList($endpoint = null)
    {
        $doc = '    "/' . ($endpoint ?? app('Resources')->getEndpointForModel(get_called_class())) . "\": {\n";
        $doc .= "      \"get\": {\n";
        $doc .= $this->swaggerTags();
        $doc .= '        "summary": "' . $this->docListDescription($endpoint) . "\",\n";
        $doc .= $this->swaggerProduces();
        $doc .= $this->swaggerParameters();
        $doc .= $this->swaggerResponses();
        $doc .= "      }\n";
        $doc .= "    },\n";

        return $doc;
    }

    /**
     * Generate swagger search endpoint documentation for this model
     *
     * @return string
     */
    public function swaggerSearch()
    {
        $doc = '    "/' . app('Resources')->getEndpointForModel(get_called_class()) . "/search\": {\n";
        $doc .= "      \"get\": {\n";
        $doc .= $this->swaggerTags(['search']);
        $doc .= '        "summary": "' . $this->docSearchDescription() . "\",\n";
        $doc .= $this->swaggerProduces();
        $doc .= $this->swaggerParameters($this->docSearchParametersRaw());
        $doc .= $this->swaggerResponses('SearchResult');
        $doc .= "      }\n";
        $doc .= "    },\n";

        return $doc;
    }

    /**
     * Generate swagger single endpoint documentation for this model
     *
     * @return string
     */
    public function swaggerSingle($endpoint = null)
    {
        $doc = '    "/' . ($endpoint ?? app('Resources')->getEndpointForModel(get_called_class())) . "/{id}\": {\n";
        $doc .= "      \"get\": {\n";
        $doc .= $this->swaggerTags();
        $doc .= '        "summary": "' . $this->docSingleDescription($endpoint) . "\",\n";
        $doc .= $this->swaggerProduces();
        $doc .= $this->swaggerParameters(['id' => 'Resource id to retrieve']);
        $doc .= $this->swaggerResponses();
        $doc .= "      }\n";
        $doc .= "    },\n";

        return $doc;
    }

    public function swaggerTags($extras = [])
    {
        $model = get_called_class();
        $endpoint = app('Resources')->getEndpointForModel($model);
        $source = $model::source();

        $doc = "        \"tags\": [\n";
        $doc .= '            "' . $endpoint . "\",\n";
        $doc .= '            "' . strtolower($source) . '"';

        foreach ($extras as $tag)
        {
            $doc .= ",\n";
            $doc .= '            "' . $tag . '"';
        }

        $doc .= "\n";
        $doc .= "        ],\n";

        return $doc;
    }

    public function swaggerProduces()
    {
        $doc = "        \"produces\": [\n";
        $doc .= "          \"application/json\"\n";
        $doc .= "        ],\n";

        return $doc;
    }

    /**
     * Generate swagger parameters for this model
     *
     * @return string
     */
    public function swaggerParameters($params = [])
    {
        $doc = "        \"parameters\": [\n";
        $array = $params ?? $this->docListParametersRaw();

        foreach ($array as $param => $description)
        {
            $doc .= "          {\n";
            $doc .= '            "$ref": "#/parameters/' . $param . "\"\n";
            $doc .= '          }' . ($description !== end($array) ? ',' : '') . "\n";
        }

        $doc .= "        ],\n";

        return $doc;
    }

    public function swaggerResponses($modelBasename = null)
    {
        if (!$modelBasename)
        {
            $model = get_called_class();
            $modelBasename = class_basename($model);
        }

        $doc = "        \"responses\": {\n";
        $doc .= "          \"200\": {\n";
        $doc .= "            \"description\": \"Successful operation\",\n";
        $doc .= "            \"schema\": {\n";
        $doc .= "              \"type\": \"array\",\n";
        $doc .= "              \"items\": {\n";
        $doc .= '                "$ref": "#/definitions/' . $modelBasename . "\"\n";
        $doc .= "              }\n";
        $doc .= "            }\n";
        $doc .= "          },\n";
        $doc .= "          \"default\": {\n";
        $doc .= "            \"description\": \"error\",\n";
        $doc .= "            \"schema\": {\n";
        $doc .= "              \"\$ref\": \"#/definitions/Error\"\n";
        $doc .= "            }\n";
        $doc .= "          }\n";
        $doc .= "        }\n";

        return $doc;
    }

    /**
     * Generate an endpoint name as copy text
     *
     * @return string
     */
    private function _endpointAsCopyText($endpoint = '')
    {
        if (!$endpoint)
        {
            $endpoint = app('Resources')->getEndpointForModel(get_called_class());
        }

        return strtolower(Str::title($endpoint));
    }

    /**
     * Generate an endpoint path
     *
     * @return string
     */
    private function _endpointPath($options = [])
    {
        $defaults = [
            'extraPath' => '',
            'id' => '',
        ];

        $options = array_merge($defaults, $options);

        $endpoint = app('Resources')->getEndpointForModel(get_called_class());

        $path = '/' . $endpoint;

        if ($options['extraPath'])
        {
            $path .= '/' . $options['extraPath'];
        }

        if ($options['id'])
        {
            $path .= '/' . $options['id'];
        }

        return rtrim($path,"/");
    }

    private function _addEllipsis(\stdClass $obj)
    {
        $keys = get_object_vars($obj);
        $addEllipsis = false;
        $i = 0;

        foreach ($keys as $keyIndex => $key)
        {
            if ($i > 5)
            {
                unset($obj->{$keyIndex});
                $addEllipsis = true;
            }
            $i++;
        }

        $obj->{'...'} = null;

        return $obj;
    }

}
