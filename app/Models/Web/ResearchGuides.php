<?php

namespace App\Models\Web;

/**
 * A research guide on the website
 */
class ResearchGuide extends Page
{

    protected $table = 'research_guides';

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
