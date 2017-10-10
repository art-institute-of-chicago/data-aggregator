<?php

namespace App\Models;

trait Documentable
{

    /**
     * Generate all documentationa for this model
     *
     * @return string
     */
    public function doc($appUrl)
    {

        if (!$appUrl)
        {

            $appUrl = config("app.url");

        }

        $doc = '';
        $doc .= $this->docTitle() ."\n\n";
        $doc .= $this->docList($appUrl) ."\n";

        if (get_called_class() == Collections\Artwork::class)
        {

            $doc .= $this->docEssentials($appUrl) ."\n";

        }

        $doc .= $this->docSearch($appUrl) ."\n";
        $doc .= $this->docSingle($appUrl) ."\n";
        $doc .= $this->docSubresource($appUrl, 'artists') ."\n";
        $doc .= $this->docSubresource($appUrl, 'copyrightRepresentatives') ."\n";

        return $doc;

    }

    /**
     * Generate a title for all endpoonts for this class
     *
     * @return string
     */
    public function docTitle()
    {

        return '## ' .title_case( $this->_endpoint() );

    }

    /**
     * Generate documentation for list endpoint
     *
     * @return string
     */
    public function docList($appUrl)
    {

        $calledClass = get_called_class();
        $endpoint = $this->_endpoint();
        $endpointAsCopyText = $this->_endpointAsCopyText();

        // Title
        $doc = '### `' .$this->_endpointPath() ."`\n\n";

        $doc .= "A list of all " .$endpointAsCopyText ." sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#" .$endpoint .").\n\n";

        $doc .= $this->docListParameters();

        $doc .= $this->docExampleOutput($appUrl);

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
        $endpoint = $this->_endpoint();
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
        $endpoint = $this->_endpoint();
        $endpointAsCopyText = $this->_endpointAsCopyText();

        // Title
        $doc = '### `' .$this->_endpointPath(['extraPath' => 'search']) ."`\n\n";

        $doc .= "Search " .$endpointAsCopyText ." data in the aggregator.\n\n";

        $doc .= $this->docSearchParameters();

        $doc .= $this->docExampleSearchOutput($appUrl, 'q=monet');

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
        $endpoint = $this->_endpoint();
        $endpointAsCopyText = $this->_endpointAsCopyText();

        // Title
        $doc = '### `' .$this->_endpointPath(['extraPath' => '{id}']) ."`\n\n";

        $doc .= "A single " .$endpointAsCopyText ." by the given identifier.";
        if (static::$source == 'collections')
        {

            $doc .= " {id} is the identifier from our collections managements system.";

        }
        $doc .= "\n\n";

        $doc .= $this->docExampleOutput($appUrl, ['id' => '111628']);

        return $doc;

    }

    /**
     * Generate documentation for subresource endpoint
     *
     * @return string
     */
    public function docSubresource($appUrl, $subEndpoint)
    {

        $calledClass = get_called_class();
        $endpoint = $this->_endpoint();
        $endpointAsCopyText = $this->_endpointAsCopyText();

        // Title
        $doc = '### `' .$this->_endpointPath(['extraPath' => '{id}/' .$subEndpoint]) ."`\n\n";

        $doc .= "The " .$this->_endpointAsCopyText($subEndpoint) ." for a given " .$endpointAsCopyText;
        $doc .= "A single " .$endpointAsCopyText ." by the given identifier.";
        if ($subEndpoint == 'artists' || $subEndpoint == 'copyrightRepresentatives')
        {

            $doc .= " Served from the API as a type of `agent`, so their output schema is the same.";

        }
        $doc .= "\n\n";

        $doc .= $this->docExampleOutput($appUrl, ['id' => '111628', 'subresource' => $subEndpoint]);

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
        $controllerClass = "\\App\\Http\\Controllers\\" .title_case( $this->_endpoint() ) ."Controller";
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
            'getParams' => '',
            'id' => '',
            'subresource' => ''
        ];

        $options = array_merge($defaults, $options);

        $doc = '';
        $doc .= "Example request: " .$appUrl .$this->_endpointPath($options) .($options['getParams'] ? "?" .$options['getParams'] : "") ."  \n"; 
        $doc .= "Example output:\n\n";

        // Mimic a controller response
        $controllerClass = "\\App\\Http\\Controllers\\" .title_case( $this->_endpoint() ) ."Controller";
        $controller = new $controllerClass;
        $transformerClass = $controller->transformer();
        $transformer = new $transformerClass;
        $response = response()->collection(static::paginate(2), $transformer, 200, [])->original;
        if ($options['extraPath'])
        {

            $response = response()->collection(static::{$options['extraPath']}()->paginate(2), $transformer, 200, [])->original;

        }
        elseif ($options['subresource'])
        {

            $subresourceClass = static::instance()->classFor($options['subresource']);
            $response = response()->collection($subresourceClass::paginate(2), $transformer, 200, [])->original;

        }
        elseif ($options['id'])
        {

            $response = response()->item(static::find($options['id']), $transformer, 200, [])->original;

        }

        // For brevity, only show the first fiew fields in the results
        if (array_keys($response['data']) === range(0, count($response['data']) - 1))
        {
            foreach ($response['data'] as $index => $datum)
            {

                $response['data'][$index] = $this->_addEllipsis($response['data'][$index]);

            }

        }
        else {

            $response['data'] = $this->_addEllipsis($response['data']);

        }
        $json = print_r(json_encode($response, JSON_PRETTY_PRINT), true);
        $json = str_replace('"...": null', '...', $json);

        // Output
        $doc .= "```\n";
        $doc .= $json ."\n";
        $doc .= "```\n";

        return $doc;
    }

    /**
     * Generate documentation for example search query and response
     *
     * @return string
     */
    public function docExampleSearchOutput($appUrl, $getParams = '')
    {

        $doc = '';
        $doc .= "Example request: " .$appUrl .$this->_endpointPath() .'/search' .($getParams ? "?" .$getParams : "") ."  \n"; 
        $doc .= "Example output:\n\n";

        // Mimic a controller response
        $controllerClass = "\\App\\Http\\Controllers\\Search\\SearchController";
        $controller = new $controllerClass;
        if ($getParams)
        {

            parse_str($getParams, $params);

        }
        $response = $controller->search($this->_endpoint(), $params);

        // For brevity, only show the first few results
        foreach ($response['data'] as $index => $datum)
        {

            if ($index > 2)
            {

                unset($response['data'][$index]);

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
     * Generate an endpoint name
     *
     * @return string
     */
    private function _endpoint()
    {

        $calledClass = get_called_class();
        return kebab_case( str_plural( class_basename($calledClass) ) );

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

            $endpoint = $this->_endpoint();
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
            'id' => ''
        ];

        $options = array_merge($defaults, $options);

        $path = '/' .$this->_endpoint();

        if ($options['extraPath'])
        {
            $path .= '/' .$options['extraPath'];
        }
        if ($options['id'])
        {
            $path .= '/' .$options['id'];
        }

        return $path;

    }

    private function _addEllipsis($array = [])
    {

        $keys = array_keys($array);
        $addEllipsis = false;
        foreach ($keys as $keyIndex => $key)
        {

            if ($keyIndex > 6)
            {

                unset($array[$key]);
                $addEllipsis = true;

            }

        }
        $array['...'] = null;

        return $array;

    }
}
