<?php

namespace App\Models\Web;

/**
 * A digital catalog on the website
 */
class DigitalCatalog extends Page
{

    protected $table = 'digital_catalogs';

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
