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
        $doc = '### `' .$this->_endpointPath('essentials') ."`\n\n";

        $doc .= "A list of essential " .$endpointAsCopyText ." sorted by last updated date in descending order. This is a subset of the `" .$endpoint ."/` endpoint that represents approximately 400 of our most well-known works. This can be used to get a shorter list of " .$endpoint ." that will have most of its metadata filled out for testing purposes.\n\n";

        $doc .= $this->docListParameters();

        $doc .= $this->docExampleOutput($appUrl, 'essentials');

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
        $doc = '### `' .$this->_endpointPath('search') ."`\n\n";

        $doc .= "Search " .$endpointAsCopyText ." data in the aggregator.\n\n";

        $doc .= $this->docSearchParameters();

        $doc .= $this->docExampleSearchOutput($appUrl, 'q=monet');

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
        $transformerClass = "\\App\\Http\\Transformers\\" .title_case( str_singular($this->_endpoint()) ) ."Transformer";
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
    public function docExampleOutput($appUrl, $extraPath = '', $getParams = '')
    {

        $doc = '';
        $doc .= "Example request: " .$appUrl .$this->_endpointPath($extraPath) .($getParams ? "?" .$getParams : "") ."  \n"; 
        $doc .= "Example output:\n\n";

        // Mimic a controller response
        $controllerClass = "\\App\\Http\\Controllers\\" .title_case( $this->_endpoint() ) ."Controller";
        $controller = new $controllerClass;
        $transformerClass = "\\App\\Http\\Transformers\\" .title_case( str_singular($this->_endpoint()) ) ."Transformer";
        $transformer = new $transformerClass;
        $response = response()->collection(static::paginate(2), $transformer, 200, [])->original;
        if ($extraPath)
        {

            $response = response()->collection(static::$extraPath()->paginate(2), $transformer, 200, [])->original;

        }

        // For brevity, only show the first fiew fields in the results
        foreach ($response['data'] as $index => $datum)
        {
            $keys = array_keys($response['data'][$index]);
            $addEllipsis = false;
            foreach ($keys as $keyIndex => $key)
            {

                if ($keyIndex > 6)
                {

                    unset($response['data'][$index][$key]);
                    $addEllipsis = true;

                }

            }
            $response['data'][$index]['...'] = null;

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
    private function _endpointAsCopyText()
    {

        return strtolower( title_case( $this->_endpoint() ) );

    }

    /**
     * Generate an endpoint path
     *
     * @return string
     */
    private function _endpointPath($extra = '')
    {

        $path = '/' .$this->_endpoint();

        if ($extra)
        {
            $path .= '/' .$extra;
        }

        return $path;

    }

}
