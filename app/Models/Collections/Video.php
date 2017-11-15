<?php

namespace App\Models\Collections;

/**
 * A moving image representation of a collections resource, like an artwork, artist, exhibition, etc.
 */
class Video extends Asset
{

    protected $table = 'assets';

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "8199a3c6-99fa-582d-449a-bc9221db54da";

    }

}
