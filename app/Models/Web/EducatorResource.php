<?php

namespace App\Models\Web;

/**
 * An educator resource on the website
 */
class EducatorResource extends Page
{

    protected $table = 'educator_resources';

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
