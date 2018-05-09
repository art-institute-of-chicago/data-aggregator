<?php

namespace App\Models\Web;

/**
 * A generic page on the website
 */
class GenericPage extends Page
{

    protected $table = 'generic_pages';


    public function getExtraFillFieldsFrom($source)
    {

        // Aggregate all the text on the page
        $text = '';
        foreach ($source->content as $c)
        {
            if ($c->type == 'paragraph')
            {
                if ($c->content)
                {

                    $text .= strip_tags($c->content->paragraph) . ' ';

                }
            }
        }

        // Get the first image
        $image_url = '';
        foreach ($source->content as $c)
        {
            if ($c->type == 'image')
            {
                $image_url = env('CMS_IMGIX_URL', '') .'/' .$c->medias[0]->uuid;
                break;
            }
        }

        return [
            'text' => $text,
            'image_url' => $image_url,
        ];

    }

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "17";

    }

}
