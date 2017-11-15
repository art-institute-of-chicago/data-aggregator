<?php

namespace App\Models\Collections;

/**
 * A website that represents a collections resource, like an artwork, artist, exhibition, etc.
 */
class Link extends Asset
{

    protected $table = 'assets';

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "3990a5f5-2ae9-3c7b-2fb8-1b0438962cd3";

    }

}
