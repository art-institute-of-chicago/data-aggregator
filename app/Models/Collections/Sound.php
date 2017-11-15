<?php

namespace App\Models\Collections;

/**
 * Audio that represents a collections resource, like an artwork, artist, exhibition, etc.
 */
class Sound extends Asset
{

    protected $table = 'assets';

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "0dc99580-0a4c-c047-31e9-f42d29ac020e";

    }

}
