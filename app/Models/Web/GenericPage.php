<?php

namespace App\Models\Web;

/**
 * A generic page on the website
 */
class GenericPage extends Page
{

    protected $table = 'generic_pages';

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
