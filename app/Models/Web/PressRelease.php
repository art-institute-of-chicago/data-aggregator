<?php

namespace App\Models\Web;

/**
 * A press release on the website
 */
class PressRelease extends Page
{

    protected $table = 'press_releases';

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "7";

    }

}
