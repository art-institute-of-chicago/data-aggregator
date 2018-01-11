<?php

namespace App\Models;

use Zend\Code\Reflection\ClassReflection;

trait Documentable
{

    /**
     * Generate endpoint documentation for this model
     *
     * @return string
     */
    public function docEndpoints($appUrl)
    {

        if ($this->docOnly())
        {

            return $this->docOnly();

        }

        if (!$appUrl)
        {

            $appUrl = config("app.url") ."/api/v1";

        }

        $doc = '';
        $doc .= $this->docTitle() ."\n\n";
        $doc .= $this->docList($appUrl) ."\n";

        if (get_called_class() == Collections\Artwork::class)
        {

            $doc .= $this->docEssentials($appUrl) ."\n";

        }

        if ($this->hasSearchEndpoint())
        {

            $doc .= $this->docSearch($appUrl) ."\n";

        }

        $doc .= $this->docSingle($appUrl) ."\n";

        foreach ($this->subresources() as $subresource)
        {

            $doc .= $this->docSubresource($appUrl, $subresource, !in_array($subresource, $this->subresourcesToSkipExampleOutput())) ."\n";

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

        $doc = '';
        $doc .= $this->docTitle() ."\n\n";
        $doc .= $this->docDescription() ." For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#" .endpointFor(get_called_class()) .").\n\n";

        if (!$this->docOnly())
        {

            $doc .= $this->docListFields() ."\n\n";

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

        return '## ' .str_replace('-', ' ', title_case( endpointFor(get_called_class()) ) );

    }

    /**
     * Generate a description of this resource
     *
     * @TODO Raise informative exception if the doc block is missing.
     *
     * @return string
     */
    public function docDescription()
    {

        $rc = new ClassReflection(get_called_class());
        return $rc->getDocBlock()->getShortDescription();

    }

    /**
     * Generate documentation for list endpoint
     *
     * @return string
     */
    public function docList($appUrl)
    {

        $calledClass = get_called_class();
        $endpoint = endpointFor(get_called_class());
        $endpointAsCopyText = $this->_endpointAsCopyText();

        // Title
        $doc = '### `' .$this->_endpointPath() ."`\n\n";

        $doc .= "A list of all " .$endpointAsCopyText ." sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#" .$endpoint .").\n\n";

        $doc .= $this->docListParameters();

        $doc .= $this->docExampleOutput($appUrl);

        return $doc;

    }

    /**
     * Generate documentation for listing fields
     *
     * @return string
     */
    public function docListFields()
    {

        $calledClass = get_called_class();
        $endpoint = endpointFor(get_called_class());
        $endpointAsCopyText = $this->_endpointAsCopyText();

        $doc = '';
        foreach ($this->transformMapping() as $array)
        {

            $doc .= "* `" .$array["name"] ."` " .(array_key_exists("type", $array) ? "*" .$array['type'] ."* " : "") ."- " .$array['doc'] ."\n";

        }

        $doc .= "\n";

        return $doc;

    }


    /**
     * Generate documentation for essentials endpoint
     *
     * @return string
     */
    public function docEssentials($appUrl)
    {

        $calledClass = get_called_class();
        $endpoint = endpointFor(get_called_class());
        $endpointAsCopyText = $this->_endpointAsCopyText();

        // Title
        $doc = '### `' .$this->_endpointPath(['extraPath' => 'essentials']) ."`\n\n";

        $doc .= "A list of essential " .$endpointAsCopyText ." sorted by last updated date in descending order. This is a subset of the `" .$endpoint ."/` endpoint that represents approximately 400 of our most well-known works. This can be used to get a shorter list of " .$endpoint ." that will have most of its metadata filled out for testing purposes.\n\n";

        $doc .= $this->docListParameters();

        $doc .= $this->docExampleOutput($appUrl, ['extraPath' => 'essentials']);

        return $doc;
    }

    /**
     * Generate documentation for search endpoint
     *
     * @return string
     */
    public function docSearch($appUrl)
    {

        $calledClass = get_called_class();
        $endpoint = endpointFor(get_called_class());
        $endpointAsCopyText = $this->_endpointAsCopyText();

        // Title
        $doc = '### `' .$this->_endpointPath(['extraPath' => 'search']) ."`\n\n";

        $doc .= "Search " .$endpointAsCopyText ." data in the aggregator. " .$this->extraSearchDescription() ."\n\n";

        $doc .= $this->docSearchParameters();

        $doc .= $this->docExampleSearchOutput($appUrl, $this->exampleSearchQuery());

        return $doc;
    }

    /**
     * Generate documentation for single resource endpoint
     *
     * @return string
     */
    public function docSingle($appUrl)
    {

        $calledClass = get_called_class();
        $endpoint = endpointFor(get_called_class());
        $endpointAsCopyText = $this->_endpointAsCopyText();

        // Title
        $doc = '### `' .$this->_endpointPath(['extraPath' => '{id}']) ."`\n\n";

        $doc .= "A single " .$endpointAsCopyText ." by the given identifier.";

        if (static::$source == 'Collections')
        {

            $doc .= " {id} is the identifier from our collections managements system.";

        }
        $doc .= "\n\n";

        $doc .= $this->docExampleOutput($appUrl, ['id' => $this->exampleId()]);

        return $doc;

    }

    /**
     * Generate documentation for subresource endpoint
     *
     * @return string
     */
    public function docSubresource($appUrl, $subEndpoint, $includeExampleOutput = true)
    {

        $calledClass = get_called_class();
        $endpoint = endpointFor(get_called_class());
        $endpointAsCopyText = $this->_endpointAsCopyText();

        // Title
        $doc = '### `' .$this->_endpointPath(['extraPath' => '{id}/' .$subEndpoint]) ."`\n\n";

        $doc .= "The " .$this->_endpointAsCopyText($subEndpoint) ." for a given " .$endpointAsCopyText .".";
        if ($subEndpoint == 'artists' || $subEndpoint == 'copyrightRepresentatives')
        {

            $doc .= " Served from the API as a type of `agent`, so their output schema is the same.";

        }
        $doc .= "\n\n";

        $doc .= $this->docExampleOutput($appUrl, ['id' => $this->exampleId(),
                                                  'subresource' => $subEndpoint,
                                                  'includeExampleOutput' => $includeExampleOutput]);

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
        $doc .= "#### Available parameters:\n\n";

        $doc .= "* `ids` - A comma-separated list of resource ids to retrieve\n";
        $doc .= "* `limit` - The number of resources to return per page\n";
        $doc .= "* `page` - The page of resources to retrieve\n";
        $doc .= "* `fields` - A comma-separated list of fields to return per resource\n";

        $doc .= $this->docIncludeParameters();

        return $doc;

    }

    /**
     * Generate documentation for parameters for search endpoints
     *
     * @return string
     */
    public function docSearchParameters()
    {

        $doc = '';

        $doc .= "#### Available parameters:\n\n";

        $doc .= "* `q` - Your search query\n";
        $doc .= "* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here\n";
        $doc .= "* `sort` - Used in conjunction with `query`\n";
        $doc .= "* `from` - Starting point of results. Pagination via Elasticsearch conventions\n";
        $doc .= "* `size` - Number of results to return. Pagination via Elasticsearch conventions\n";
        $doc .= "* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.\n";
        $doc .= "\n";

        return $doc;

    }

    /**
     * Generate documentation for the `include` parameters for list endpoints
     *
     * @return string
     */
    public function docIncludeParameters()
    {

        $doc = '';
        $controllerClass = "\\App\\Http\\Controllers\\" .ucfirst( camel_case( endpointFor(get_called_class()) ) ) ."Controller";

        // TODO: Make all this more declarative!
        // Alternatively, rename the controllers to plural?
        if( $controllerClass == '\App\Http\Controllers\LibraryMaterialsController' )
        {
            $controllerClass = '\App\Http\Controllers\LibraryMaterialController';
        }

        // TODO: Make all this more declarative!
        if( $controllerClass == '\App\Http\Controllers\LibraryTermsController' )
        {
            $controllerClass = '\App\Http\Controllers\LibraryTermController';
        }

        $controller = new $controllerClass;
        $transformerClass = $controller->transformer();
        $transformer = new $transformerClass;
        if ($transformer->getAvailableIncludes())
        {

            $doc .= "* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:\n";
            foreach ($transformer->getAvailableIncludes() as $include)
            {

                $doc .= "  * `" .$include ."`\n";

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
    public function docExampleOutput($appUrl, $options = [])
    {

        $defaults = [
            'extraPath' => '',
            'getParams' => 'limit=2',
            'id' => '',
            'subresource' => '',
            'includeExampleOutput' => true,
        ];

        $options = array_merge($defaults, $options);

        $requestUrl = $appUrl .$this->_endpointPath($options) .($options['getParams'] ? "?" .$options['getParams'] : "");

        $doc = '';
        $doc .= "Example request: " .$requestUrl ."  \n";

        if ($options['includeExampleOutput'])
        {
            $doc .= "Example output:\n\n";

            $response = json_decode(file_get_contents($requestUrl));

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
            $json = print_r(json_encode($response, JSON_PRETTY_PRINT), true);
            $json = str_replace('"...": null', '...', $json);

            // Output
            $doc .= "```\n";
            $doc .= $json ."\n";
            $doc .= "```\n";

        }

        return $doc;
    }

    /**
     * Generate documentation for example search query and response
     *
     * @return string
     */
    public function docExampleSearchOutput($appUrl, $getParams = '')
    {

        $requestUrl = $appUrl .$this->_endpointPath() .'/search' .($getParams ? "?" .$getParams : "");

        $doc = '';
        $doc .= "Example request: " .$requestUrl ."  \n";
        $doc .= "Example output:\n\n";

        $response = json_decode(file_get_contents($requestUrl));

        // For brevity, only show the first few results
        foreach ($response->data as $index => $datum)
        {

            if ($index > 2)
            {

                unset($response->data[$index]);

            }

        }
        $json = print_r(json_encode($response, JSON_PRETTY_PRINT), true);

        // Output
        $doc .= "```\n";
        $doc .= $json ."\n";
        $doc .= "```\n";

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

            $endpoint = endpointFor(get_called_class());
        }

        return strtolower( title_case( $endpoint ) );

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
            'subresource' => '',
        ];

        $options = array_merge($defaults, $options);

        $path = '/' .endpointFor(get_called_class());

        if ($options['extraPath'])
        {
            $path .= '/' .$options['extraPath'];
        }
        if ($options['id'])
        {
            $path .= '/' .$options['id'];
        }
        if ($options['subresource'])
        {
            $path .= '/' .$options['subresource'];
        }

        return $path;

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

                unset($obj->$keyIndex);
                $addEllipsis = true;

            }
            $i++;
        }
        $obj->{"..."} = null;

        return $obj;

    }

    /**
     * Get the subresources for the resource.
     *
     * @return array
     */
    public function subresources()
    {

        return [];

    }

    /**
     * Get the subresources to skip the example output for.
     *
     * @return array
     */
    public function subresourcesToSkipExampleOutput()
    {

        return [];

    }

    /**
     * Get any extra descriptions of the search endpoint for this resource
     *
     * @return string
     */
    public function extraSearchDescription()
    {

        return "";

    }

    /**
     * Get an example search query for documentation generation
     *
     * @return string
     */
    public function exampleSearchQuery()
    {

        return "";

    }

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "";

    }

    /**
     * For this resource, use this as the full documentation.
     *
     * @return string
     */
    public function docOnly()
    {

        return "";

    }

    /**
     * Whether this resource has a `/search` endpoint
     *
     * @return boolean
     */
    public function hasSearchEndpoint()
    {

        return true;

    }

}
