<?php

namespace App\Models;

trait Documentable
{

    /**
     * Generate a documentation title
     *
     * @return string
     */
    protected static function docTitle()
    {

        $calledClass = get_called_class();

        return '## ' .title_case( str_plural( class_basename($calledClass) ) );

    }

    /**
     * Generate documentation for list endpoint
     *
     * @return string
     */
    protected static function docList($appUrl)
    {

        $calledClass = get_called_class();
        $endpoint = strtolower( str_plural( class_basename($calledClass) ) );

        // Title
        $doc = '### `/' .$endpoint ."`\n\n";

        $doc .= "A list of all artworks sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#" .$endpoint .").\n\n";


        // Parameters
        $doc .= "#### Available parameters:\n\n";

        $doc .= "* `ids` - A comma-separated list of artwork ids to retrieve\n";
        $doc .= "* `limit` - The number of records to return per page\n";
        $doc .= "* `page` - The page of records to retrieve\n";
        $doc .= "* `fields` - A comma-separated list of fields to return per record\n";


        // Include parameters
        $transformerClass = "\\App\\Http\\Transformers\\" .title_case( str_singular($endpoint) ) ."Transformer";
        $transformer = new $transformerClass;
        if ($transformer->getAvailableIncludes())
        {

            $doc .= "* `include` - A comma-separated list of subresource to embed in the returned records. Available options are:\n";
            foreach ($transformer->getAvailableIncludes() as $include)
            {

                $doc .= "  * `" .$include ."`\n";

            }

        }
        $doc .= "\n";


        // Example output
        $doc .= "Example request: " .$appUrl ."/api/v1/artworks  \n"; 
        $doc .= "Example output:\n\n";

        $doc .= "```\n";
        $controllerClass = "\\App\\Http\\Controllers\\" .title_case( $endpoint ) ."Controller";
        $controller = new $controllerClass;
        $response = response()->collection(static::paginate(2), $transformer, 200, [])->original;
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
        $doc .= $json ."\n";
        $doc .= "```\n";

        return $doc;

    }

    protected static function doc($appUrl)
    {

        if (!$appUrl)
        {

            $appUrl = config("app.url");

        }

        $doc = '';
        $doc .= static::docTitle() ."\n\n";
        $doc .= static::docList($appUrl) ."\n";

        return $doc;

    }
}
