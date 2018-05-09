<?php

namespace App\Models\Web;

/**
 * An printed catalog on the website
 */
class PrintedCatalog extends Page
{

    protected $table = 'printed_catalogs';

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
