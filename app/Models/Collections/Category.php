<?php

namespace App\Models\Collections;

use App\Models\Documentable;

/**
 * Tag-like classifications of artworks and other resources.
 */
class Category extends CategoryTerm
{

    use Documentable;

    protected static $isCategory = true;

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "PC-3";

    }

}
