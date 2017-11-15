<?php

namespace App\Models\Collections;

/**
 * Text that represents a collections resource, like an artwork, artist, exhibition, etc.
 */
class Text extends Asset
{

    protected $table = 'assets';

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "28f4641e-c040-7669-6036-f6fce1e25514";

    }

}
